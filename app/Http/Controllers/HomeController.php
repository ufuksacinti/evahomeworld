<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Collection;
use App\Models\Category;
use App\Models\Campaign;
use App\Models\BulkOrder;
use App\Services\CacheService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $cacheService;

    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    public function index()
    {
        // Featured products - cached
        $featuredProducts = $this->cacheService->getFeaturedProducts(8);

        // Popular products (most viewed) - cached
        $popularProducts = $this->cacheService->getPopularProducts(8);

        // Best sellers - cached
        $bestSellers = $this->cacheService->getBestSellers(8);

        // Collections - cached
        $shopCollections = $this->cacheService->getShopCollections()->take(4);
        $energyCollections = $this->cacheService->getEnergyCollections()->take(4);
        $allEnergyCollections = $this->cacheService->getEnergyCollections(); // All energy collections for interactive hero

        // Active campaigns
        $campaigns = Campaign::where('is_active', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->take(3)
            ->get();

        // Statistics
        $stats = [
            'total_products' => Product::count(),
            'total_orders' => \App\Models\Order::count(),
            'total_customers' => \App\Models\User::where('role', 'customer')->count(),
        ];

        return view('home', compact(
            'featuredProducts',
            'popularProducts',
            'bestSellers',
            'shopCollections',
            'energyCollections',
            'allEnergyCollections',
            'campaigns',
            'stats'
        ));
    }

    public function bulkOrder()
    {
        return view('bulk-order');
    }

    public function submitBulkOrder(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'message' => 'required|string',
        ]);

        BulkOrder::create([
            'user_id' => auth()->id(),
            'company_name' => $request->company_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Toplu sipariş talebiniz alındı. En kısa sürede sizinle iletişime geçeceğiz.');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function sendContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // TODO: Send email to admin
        // Mail::to(config('mail.admin'))->send(new ContactFormMail($request->all()));

        return redirect()->back()->with('success', 'Mesajınız başarıyla gönderildi. En kısa sürede sizinle iletişime geçeceğiz.');
    }
}
