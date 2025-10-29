<?php

namespace App\Observers;

use App\Models\Collection;
use App\Services\CacheService;

class CollectionObserver
{
    protected $cacheService;

    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    /**
     * Handle the Collection "created" event.
     */
    public function created(Collection $collection): void
    {
        $this->cacheService->clearCollectionCaches();
    }

    /**
     * Handle the Collection "updated" event.
     */
    public function updated(Collection $collection): void
    {
        $this->cacheService->clearCollectionCaches();
    }

    /**
     * Handle the Collection "deleted" event.
     */
    public function deleted(Collection $collection): void
    {
        $this->cacheService->clearCollectionCaches();
    }
}

