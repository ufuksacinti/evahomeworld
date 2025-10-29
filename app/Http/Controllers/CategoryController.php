<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = Category::where('is_active', true);
        
        if (Schema::hasColumn('categories', 'sort_order')) {
            $categories = $categories->orderBy('sort_order');
        } else {
            $categories = $categories->orderBy('created_at', 'desc');
        }
        
        $categories = $categories->get();
        
        return view('categories.index', compact('categories'));
    }

    /**
     * Display the specified category.
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->with(['activeProducts.energyCollection'])
            ->firstOrFail();
        
        $products = $category->activeProducts()->paginate(12);
        
        return view('categories.show', compact('category', 'products'));
    }
}
