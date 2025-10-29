<?php

namespace App\Providers;

use App\Models\Collection;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share navigation data with main layout
        View::composer('layouts.main', function ($view) {
            // SHOP Menu - Categories with children
            $shopCategories = \App\Models\Category::where('is_active', true)
                ->whereNull('parent_id')
                ->with('children')
                ->orderBy('order')
                ->get();

            // COLLECTIONS Menu - Only Energy Collections
            $energyCollections = Collection::where('is_active', true)
                ->where('type', 'energy')
                ->orderBy('order')
                ->get();

            $view->with([
                'shopCategories' => $shopCategories,
                'energyCollections' => $energyCollections,
            ]);
        });
    }
}
