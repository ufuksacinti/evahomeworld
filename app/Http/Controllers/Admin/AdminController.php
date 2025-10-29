<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\EnergyCollection;
use App\Models\Category;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'total_users' => User::where('role', 'user')->count(),
            'total_collections' => EnergyCollection::count(),
        ];

        $recent_orders = Order::with('user')->latest()->take(5)->get();
        $top_products = Product::with('energyCollection')->orderBy('view_count', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_orders', 'top_products'));
    }
}
