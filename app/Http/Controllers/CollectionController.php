<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Services\CacheService;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    protected $cacheService;

    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    /**
     * Display a listing of all collections.
     */
    public function index()
    {
        $collections = $this->cacheService->getAllCollections();

        return view('collections.index', compact('collections'));
    }

    /**
     * Display the specified collection with its products.
     */
    public function show($slug)
    {
        $collection = $this->cacheService->getCollectionBySlug($slug);

        $products = $collection->products()
            ->where('is_active', true)
            ->with(['images', 'category'])
            ->paginate(12);

        // Get other collections for sidebar - cached
        $otherCollections = $this->cacheService->getOtherCollections($collection);

        return view('collections.show', compact('collection', 'products', 'otherCollections'));
    }
}
