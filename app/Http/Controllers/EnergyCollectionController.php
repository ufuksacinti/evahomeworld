<?php

namespace App\Http\Controllers;

use App\Models\EnergyCollection;
use Illuminate\Http\Request;

class EnergyCollectionController extends Controller
{
    /**
     * Display a listing of the energy collections.
     */
    public function index()
    {
        $collections = EnergyCollection::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
        
        return view('collections.index', compact('collections'));
    }

    /**
     * Display the specified energy collection.
     */
    public function show($slug)
    {
        $collection = EnergyCollection::where('slug', $slug)
            ->where('is_active', true)
            ->with(['activeProducts.category'])
            ->firstOrFail();
        
        $products = $collection->activeProducts()->paginate(12);
        
        return view('collections.show', compact('collection', 'products'));
    }
}
