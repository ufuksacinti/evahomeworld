<?php

namespace App\Services;

use App\Models\Collection;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class CacheService
{
    /**
     * Cache duration in seconds (1 hour)
     */
    private const CACHE_DURATION = 3600;

    /**
     * Get cached shop collections
     */
    public function getShopCollections()
    {
        return Cache::remember('collections.shop', self::CACHE_DURATION, function () {
            return Collection::where('is_active', true)
                ->where('type', 'shop')
                ->orderBy('order')
                ->get();
        });
    }

    /**
     * Get cached energy collections
     */
    public function getEnergyCollections()
    {
        return Cache::remember('collections.energy', self::CACHE_DURATION, function () {
            return Collection::where('is_active', true)
                ->where('type', 'energy')
                ->orderBy('order')
                ->get();
        });
    }

    /**
     * Get all active collections
     */
    public function getAllCollections()
    {
        return Cache::remember('collections.all', self::CACHE_DURATION, function () {
            return Collection::where('is_active', true)
                ->orderBy('order')
                ->get();
        });
    }

    /**
     * Get featured products
     */
    public function getFeaturedProducts(int $limit = 8)
    {
        return Cache::remember("products.featured.{$limit}", self::CACHE_DURATION, function () use ($limit) {
            return Product::where('is_featured', true)
                ->where('is_active', true)
                ->with(['images', 'collection'])
                ->take($limit)
                ->get();
        });
    }

    /**
     * Get popular products (most viewed)
     */
    public function getPopularProducts(int $limit = 8)
    {
        return Cache::remember("products.popular.{$limit}", self::CACHE_DURATION / 2, function () use ($limit) {
            return Product::where('is_active', true)
                ->with(['images', 'collection'])
                ->orderBy('view_count', 'desc')
                ->take($limit)
                ->get();
        });
    }

    /**
     * Get best selling products
     */
    public function getBestSellers(int $limit = 8)
    {
        return Cache::remember("products.bestsellers.{$limit}", self::CACHE_DURATION / 2, function () use ($limit) {
            return Product::where('is_active', true)
                ->with(['images', 'collection'])
                ->orderBy('sale_count', 'desc')
                ->take($limit)
                ->get();
        });
    }

    /**
     * Get collection by slug with caching
     */
    public function getCollectionBySlug(string $slug)
    {
        return Cache::remember("collection.{$slug}", self::CACHE_DURATION, function () use ($slug) {
            return Collection::where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();
        });
    }

    /**
     * Get other collections of same type
     */
    public function getOtherCollections(Collection $collection, int $limit = 6)
    {
        $cacheKey = "collections.other.{$collection->type}.{$collection->id}.{$limit}";
        
        return Cache::remember($cacheKey, self::CACHE_DURATION, function () use ($collection, $limit) {
            return Collection::where('is_active', true)
                ->where('type', $collection->type)
                ->where('id', '!=', $collection->id)
                ->orderBy('order')
                ->take($limit)
                ->get();
        });
    }

    /**
     * Clear all collection caches
     */
    public function clearCollectionCaches()
    {
        Cache::forget('collections.shop');
        Cache::forget('collections.energy');
        Cache::forget('collections.all');
        
        // Clear all collection-specific caches
        Collection::all()->each(function ($collection) {
            Cache::forget("collection.{$collection->slug}");
            Cache::forget("collections.other.{$collection->type}.{$collection->id}.6");
        });
    }

    /**
     * Clear all product caches
     */
    public function clearProductCaches()
    {
        Cache::forget('products.featured.8');
        Cache::forget('products.popular.8');
        Cache::forget('products.bestsellers.8');
        
        // Clear various limits
        for ($i = 1; $i <= 20; $i++) {
            Cache::forget("products.featured.{$i}");
            Cache::forget("products.popular.{$i}");
            Cache::forget("products.bestsellers.{$i}");
        }
    }

    /**
     * Clear all caches
     */
    public function clearAllCaches()
    {
        $this->clearCollectionCaches();
        $this->clearProductCaches();
    }
}

