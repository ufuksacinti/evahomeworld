<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true)->with('images', 'category');

        // Search
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Sort
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'popular':
                $query->orderBy('view_count', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate(12);
        $categories = Category::where('is_active', true)->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with(['images', 'collection', 'attributes'])
            ->firstOrFail();

        // Increment view count
        $product->increment('view_count');

        // Related products from same collection
        $relatedProducts = Product::where('collection_id', $product->collection_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->with(['images', 'collection'])
            ->take(4)
            ->get();

        // Check if in favorites
        $isFavorite = false;
        if (auth()->check()) {
            $isFavorite = Favorite::where('user_id', auth()->id())
                ->where('product_id', $product->id)
                ->exists();
        }

        return view('products.show', compact('product', 'relatedProducts', 'isFavorite'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $products = Product::where('category_id', $category->id)
            ->where('is_active', true)
            ->with('images')
            ->paginate(12);

        return view('products.category', compact('category', 'products'));
    }

    public function favorites()
    {
        $favorites = Favorite::where('user_id', auth()->id())
            ->with('product.images')
            ->get();

        return view('products.favorites', compact('favorites'));
    }

    public function addToFavorites(Product $product)
    {
        $exists = Favorite::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->exists();

        if (!$exists) {
            Favorite::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
            ]);
        }

        return redirect()->back()->with('success', 'Ürün favorilere eklendi.');
    }

    public function removeFromFavorites(Product $product)
    {
        Favorite::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->delete();

        return redirect()->back()->with('success', 'Ürün favorilerden çıkarıldı.');
    }
}
