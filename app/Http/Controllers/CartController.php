<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Notifications\OrderPlacedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    private function getOrCreateCart()
    {
        if (auth()->check()) {
            $cart = Cart::firstOrCreate(
                ['user_id' => auth()->id()],
                ['session_id' => null]
            );
        } else {
            $sessionId = session()->getId();
            $cart = Cart::firstOrCreate(
                ['session_id' => $sessionId],
                ['user_id' => null]
            );
        }

        return $cart;
    }

    public function index()
    {
        $cart = $this->getOrCreateCart();
        $cart->load('items.product.images');

        return view('cart.index', compact('cart'));
    }

    public function add(Product $product, Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        if ($product->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Yetersiz stok.');
        }

        $cart = $this->getOrCreateCart();
        $cart->addItem($product, $request->quantity);

        return redirect()->back()->with('success', 'Ürün sepete eklendi.');
    }

    public function update(Product $product, Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = $this->getOrCreateCart();
        $cart->updateQuantity($product->id, $request->quantity);

        return redirect()->back()->with('success', 'Sepet güncellendi.');
    }

    public function remove(Product $product)
    {
        $cart = $this->getOrCreateCart();
        $cart->removeItem($product->id);

        return redirect()->back()->with('success', 'Ürün sepetten çıkarıldı.');
    }

    public function clear()
    {
        $cart = $this->getOrCreateCart();
        $cart->clear();

        return redirect()->back()->with('success', 'Sepet temizlendi.');
    }

    public function checkout()
    {
        $cart = $this->getOrCreateCart();
        $cart->load('items.product');

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Sepetiniz boş.');
        }

        $addresses = auth()->user()->addresses;

        return view('cart.checkout', compact('cart', 'addresses'));
    }

    public function processOrder(Request $request)
    {
        $request->validate([
            'shipping_address_id' => 'required|exists:addresses,id',
            'billing_address_id' => 'required|exists:addresses,id',
            'payment_method' => 'required|in:iyzico,shopier',
        ]);

        $cart = $this->getOrCreateCart();
        $cart->load('items.product');

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Sepetiniz boş.');
        }

        DB::beginTransaction();
        try {
            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'total_amount' => $cart->getTotalAmount(),
                'discount_amount' => 0,
                'shipping_amount' => 0,
                'status' => 'pending',
                'payment_status' => 'pending',
                'payment_method' => $request->payment_method,
                'shipping_address' => auth()->user()->addresses()->find($request->shipping_address_id)->toArray(),
                'billing_address' => auth()->user()->addresses()->find($request->billing_address_id)->toArray(),
            ]);

            // Create order items
            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'total' => $item->getTotal(),
                ]);

                // Update product stock and sale count
                $item->product->decrement('stock', $item->quantity);
                $item->product->incrementSaleCount($item->quantity);
            }

            // Clear cart
            $cart->clear();

            DB::commit();

            // Send order confirmation notification
            try {
                auth()->user()->notify(new OrderPlacedNotification($order));
            } catch (\Exception $e) {
                Log::error('Failed to send order notification', [
                    'order_id' => $order->id,
                    'error' => $e->getMessage(),
                ]);
            }

            // Here you would integrate with Iyzico or Shopier
            // For now, we'll just redirect to success page

            return redirect()->route('order.detail', $order)->with('success', 'Siparişiniz alındı.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Sipariş oluşturulurken bir hata oluştu: ' . $e->getMessage());
        }
    }

    public function myOrders()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('items')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function orderDetail(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items.product');

        return view('orders.show', compact('order'));
    }
}
