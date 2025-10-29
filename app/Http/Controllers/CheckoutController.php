<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Show checkout form
     */
    public function index()
    {
        $cart = currentCart();
        
        if ($cart->items()->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }
        
        $items = $cart->items()->with('product')->get();
        $user = Auth::user();
        
        return view('checkout.index', compact('cart', 'items', 'user'));
    }
    
    /**
     * Process checkout and create order
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'nullable|string',
            'shipping_address' => 'required|string',
            'shipping_city' => 'required|string',
            'shipping_zip' => 'required|string',
            'shipping_country' => 'required|string',
            'order_notes' => 'nullable|string',
        ]);
        
        $cart = currentCart();
        
        if ($cart->items()->count() === 0) {
            return response()->json([
                'success' => false,
                'message' => 'Your cart is empty',
            ], 400);
        }
        
        // Stok kontrolü
        foreach ($cart->items as $item) {
            if (!$item->product->hasStock($item->quantity)) {
                return response()->json([
                    'success' => false,
                    'message' => "Insufficient stock for {$item->product->name}",
                ], 400);
            }
        }
        
        // Order oluştur
        $order = \App\Models\Order::create([
            'order_number' => \App\Models\Order::generateOrderNumber(),
            'user_id' => Auth::id(),
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'shipping_address' => $request->shipping_address,
            'shipping_city' => $request->shipping_city,
            'shipping_zip' => $request->shipping_zip,
            'shipping_country' => $request->shipping_country,
            'billing_address' => $request->billing_address ?? $request->shipping_address,
            'billing_city' => $request->billing_city ?? $request->shipping_city,
            'billing_zip' => $request->billing_zip ?? $request->shipping_zip,
            'subtotal' => $cart->total,
            'tax' => $request->tax ?? 0,
            'shipping_cost' => $request->shipping_cost ?? 0,
            'discount' => 0,
            'total' => $cart->total + ($request->tax ?? 0) + ($request->shipping_cost ?? 0),
            'currency' => 'TRY',
            'status' => 'pending',
            'payment_status' => 'pending',
            'order_notes' => $request->order_notes,
        ]);
        
        // Order items oluştur
        foreach ($cart->items as $item) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_name' => $item->product->name,
                'product_sku' => $item->product->sku,
                'product_price' => $item->price,
                'quantity' => $item->quantity,
                'subtotal' => $item->subtotal,
            ]);
            
            // Stoktan düş
            $item->product->decrement('stock_quantity', $item->quantity);
            $item->product->decrement('reserved_stock', $item->quantity);
        }
        
        // Sepeti temizle
        $cart->items()->delete();
        $cart->delete();
        
        // Ödeme sayfasına yönlendir
        return redirect()->route('payment.process', $order->id);
    }
}
