<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\EnergyCollection;
use App\Models\Category;

class ProductManagementController extends Controller
{
    public function index()
    {
        $products = Product::with(['energyCollection', 'category'])->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $collections = EnergyCollection::where('is_active', true)->get();
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.create', compact('collections', 'categories'));
    }

    public function store(Request $request)
    {
        // Implement product creation logic
        return redirect()->route('admin.products.index');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $collections = EnergyCollection::where('is_active', true)->get();
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.edit', compact('product', 'collections', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Implement product update logic
        return redirect()->route('admin.products.index');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Ürün başarıyla silindi.');
    }
}
