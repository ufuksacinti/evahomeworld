<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistics
        $stats = [
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'total_customers' => User::where('role', 'customer')->count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'total_revenue' => Order::where('payment_status', 'paid')->sum('total_amount'),
        ];

        // Most viewed products
        $mostViewedProducts = Product::orderBy('view_count', 'desc')
            ->with('images')
            ->take(5)
            ->get();

        // Best selling products
        $bestSellingProducts = Product::orderBy('sale_count', 'desc')
            ->with('images')
            ->take(5)
            ->get();

        // Recent orders
        $recentOrders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Low stock products
        $lowStockProducts = Product::where('stock', '<=', 10)
            ->where('is_active', true)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'mostViewedProducts',
            'bestSellingProducts',
            'recentOrders',
            'lowStockProducts'
        ));
    }

    public function settings()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->back()->with('success', 'Ayarlar güncellendi.');
    }

    public function customers()
    {
        $customers = User::where('role', 'customer')
            ->withCount('orders')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.customers.index', compact('customers'));
    }

    public function customerShow(User $user)
    {
        $user->load(['orders', 'addresses']);
        return view('admin.customers.show', compact('user'));
    }

    public function bulkOrders()
    {
        $bulkOrders = \App\Models\BulkOrder::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.bulk-orders.index', compact('bulkOrders'));
    }

    public function updateBulkOrderStatus(Request $request, \App\Models\BulkOrder $bulkOrder)
    {
        $request->validate([
            'status' => 'required|in:pending,contacted,completed,cancelled',
        ]);

        $bulkOrder->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Toplu sipariş durumu güncellendi.');
    }
}
