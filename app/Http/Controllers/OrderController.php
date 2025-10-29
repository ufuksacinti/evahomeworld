<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display user's orders
     */
    public function index()
    {
        $user = Auth::user();
        
        $orders = Order::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('orders.index', compact('orders'));
    }
    
    /**
     * Show order details
     */
    public function show($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        $items = $order->items()->with('product')->get();
        
        return view('orders.show', compact('order', 'items'));
    }
}
