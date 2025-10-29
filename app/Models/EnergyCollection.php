<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EnergyCollection extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'color_code',
        'description',
        'image',
        'sort_order',
        'is_active',
    ];

    /**
     * Get the products for the energy collection.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the active products for the energy collection.
     */
    public function activeProducts(): HasMany
    {
        return $this->hasMany(Product::class)->where('is_active', true);
    }
}
