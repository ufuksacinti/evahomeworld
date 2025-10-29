<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index(Request $request)
    {
        $query = Product::where('is_active', true)
            ->with(['energyCollection', 'category']);
        
        // Filter by energy collection
        if ($request->has('collection')) {
            $query->whereHas('energyCollection', function($q) use ($request) {
                $q->where('slug', $request->collection);
            });
        }
        
        // Filter by category
        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        
        $products = $query->orderBy('sort_order')->paginate(12);
        
        return view('products.index', compact('products'));
    }

    /**
     * Display the specified product.
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with(['energyCollection', 'category', 'images'])
            ->firstOrFail();
        
        // Get related products from same collection
        $relatedProducts = Product::where('energy_collection_id', $product->energy_collection_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->with(['energyCollection', 'category'])
            ->take(4)
            ->get();
        
        return view('products.show', compact('product', 'relatedProducts'));
    }
}
