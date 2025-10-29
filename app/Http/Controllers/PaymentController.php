<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Initialize payment
     */
    public function process($orderId)
    {
        $order = Order::where('user_id', Auth::id())
            ->where('payment_status', 'pending')
            ->findOrFail($orderId);
        
        $items = $order->items;
        
        // İyzico için hazırlık
        $paymentData = [
            'locale' => app()->getLocale() == 'tr' ? 'tr' : 'en',
            'conversationId' => $order->order_number,
            'price' => number_format($order->total, 2, '.', ''),
            'paidPrice' => number_format($order->total, 2, '.', ''),
            'currency' => 'TRY',
            'basketId' => $order->id,
            'paymentCard' => [
                'cardHolderName' => $order->customer_name,
                'cardNumber' => '',
                'expireMonth' => '',
                'expireYear' => '',
                'cvc' => '',
            ],
            'buyer' => [
                'id' => $order->user_id ?? 'guest',
                'name' => $order->customer_name,
                'surname' => '',
                'gsmNumber' => $order->customer_phone ?? '',
                'email' => $order->customer_email,
                'identityNumber' => '',
                'lastLoginDate' => now()->toDateTimeString(),
                'registrationDate' => now()->toDateTimeString(),
                'registrationAddress' => $order->shipping_address,
                'ip' => request()->ip(),
                'city' => $order->shipping_city,
                'country' => $order->shipping_country,
                'zipCode' => $order->shipping_zip,
            ],
            'shippingAddress' => [
                'contactName' => $order->customer_name,
                'city' => $order->shipping_city,
                'country' => $order->shipping_country,
                'address' => $order->shipping_address,
                'zipCode' => $order->shipping_zip,
            ],
            'billingAddress' => [
                'contactName' => $order->customer_name,
                'city' => $order->shipping_city,
                'country' => $order->shipping_country,
                'address' => $order->shipping_address,
                'zipCode' => $order->shipping_zip,
            ],
            'basketItems' => []
        ];
        
        foreach ($items as $item) {
            $paymentData['basketItems'][] = [
                'id' => $item->product_id,
                'name' => $item->product_name,
                'category1' => $item->product->category->name ?? 'General',
                'itemType' => 'PHYSICAL',
                'price' => number_format($item->product_price, 2, '.', ''),
            ];
        }
        
        return view('payment.index', compact('order', 'paymentData'));
    }
    
    /**
     * Handle payment callback
     */
    public function callback(Request $request)
    {
        $request->validate([
            'token' => 'required',
        ]);
        
        // İyzico'dan gelen token ile ödeme sonucunu al
        $token = $request->token;
        
        // İyzico API çağrısı yapılacak
        // Burada İyzico entegrasyonu tamamlanacak
        
        $orderId = $request->session()->get('order_id');
        $order = Order::findOrFail($orderId);
        
        // Ödeme başarılı ise
        $order->update([
            'payment_status' => 'paid',
            'status' => 'processing',
            'payment_method' => 'İyzico',
        ]);
        
        return redirect()->route('orders.success', $order->id);
    }
    
    /**
     * Show payment success page
     */
    public function success($orderId)
    {
        $order = Order::findOrFail($orderId);
        
        return view('payment.success', compact('order'));
    }
    
    /**
     * Show payment failure page
     */
    public function failure($orderId)
    {
        $order = Order::findOrFail($orderId);
        
        return view('payment.failure', compact('order'));
    }
}
