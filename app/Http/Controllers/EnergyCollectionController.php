<?php

namespace App\Http\Controllers;

use App\Models\EnergyCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class EnergyCollectionController extends Controller
{
    /**
     * Display a listing of the energy collections.
     */
    public function index()
    {
        $collections = EnergyCollection::where('is_active', true);
        
        if (Schema::hasTable('energy_collections') && Schema::hasColumn('energy_collections', 'sort_order')) {
            $collections = $collections->orderBy('sort_order');
        } else {
            $collections = $collections->orderBy('created_at', 'desc');
        }
        
        $collections = $collections->get();
        
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
