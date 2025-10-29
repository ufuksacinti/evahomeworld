<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\EnergyCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index()
    {
        // Rating kolonu var mı kontrol et
        $hasRatingColumn = Schema::hasColumn('products', 'rating');
        
        // En çok beğenilenler (rating ve view_count'a göre)
        $mostLikedProducts = Product::where('is_active', true)
            ->with(['energyCollection', 'category']);
        
        // Rating kolonu varsa rating'e göre filtrele ve sırala
        if ($hasRatingColumn) {
            $mostLikedProducts = $mostLikedProducts
                ->where('rating', '>', 4) // Yüksek puanlılar
                ->orderBy('rating', 'desc');
        }
        
        // View count kolonu varsa ona göre sırala
        if (Schema::hasColumn('products', 'view_count')) {
            $mostLikedProducts = $mostLikedProducts->orderBy('view_count', 'desc');
        }
        
        if ($hasRatingColumn && Schema::hasColumn('products', 'rating_count')) {
            $mostLikedProducts = $mostLikedProducts->orderBy('rating_count', 'desc');
        }
        
        $mostLikedProducts = $mostLikedProducts
            ->orderBy('created_at', 'desc') // Son eklenenler
            ->take(8)
            ->get();
        
        // Eğer 8 üründen az varsa, featured products ekle
        $featuredProducts = collect();
        if ($mostLikedProducts->count() < 8) {
            $featuredProducts = Product::where('is_active', true)
                ->where('is_featured', true)
                ->with(['energyCollection', 'category'])
                ->orderBy('sort_order')
                ->take(8)
                ->get();
        }
        
        // Eğer hala ürün yoksa, en son eklenenleri göster
        if ($mostLikedProducts->count() === 0 && $featuredProducts->count() === 0) {
            $mostLikedProducts = Product::where('is_active', true)
                ->with(['energyCollection', 'category'])
                ->orderBy('created_at', 'desc')
                ->take(8)
                ->get();
        } else {
            $mostLikedProducts = $mostLikedProducts->merge($featuredProducts)->take(8);
        }
        
        $energyCollections = EnergyCollection::where('is_active', true)
            ->orderBy('sort_order')
            ->take(4)
            ->get();
        
        return view('home', compact('mostLikedProducts', 'energyCollections'));
    }
}
