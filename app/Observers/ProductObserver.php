<?php

namespace App\Observers;

use App\Models\Product;
use App\Services\CacheService;

class ProductObserver
{
    protected $cacheService;

    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        $this->cacheService->clearProductCaches();
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        $this->cacheService->clearProductCaches();
        
        // If collection changed, clear collection caches too
        if ($product->isDirty('collection_id')) {
            $this->cacheService->clearCollectionCaches();
        }
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        $this->cacheService->clearProductCaches();
        $this->cacheService->clearCollectionCaches();
    }
}

