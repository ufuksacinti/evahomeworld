<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'slug',
        'description',
        'short_description',
        'energy_collection_id',
        'category_id',
        'price',
        'discount_price',
        'currency',
        'stock_quantity',
        'reserved_stock',
        'low_stock_threshold',
        'in_stock',
        'manage_stock',
        'allow_backorder',
        'image',
        'gallery',
        'sort_order',
        'is_featured',
        'is_active',
        'view_count',
        'rating',
        'rating_count',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'gallery' => 'array',
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'in_stock' => 'boolean',
        'manage_stock' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'rating' => 'decimal:2',
    ];

    /**
     * Get the energy collection that owns the product.
     */
    public function energyCollection(): BelongsTo
    {
        return $this->belongsTo(EnergyCollection::class);
    }

    /**
     * Get the category that owns the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the images for the product.
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    /**
     * Get the primary image for the product.
     */
    public function primaryImage(): HasMany
    {
        return $this->hasMany(ProductImage::class)->where('is_primary', true);
    }

    /**
     * Get the final price of the product.
     */
    public function finalPrice(): float
    {
        return $this->discount_price ?? $this->price;
    }

    /**
     * Check if product has discount.
     */
    public function hasDiscount(): bool
    {
        return $this->discount_price !== null && $this->discount_price < $this->price;
    }

    /**
     * Get discount percentage.
     */
    public function discountPercentage(): int
    {
        if (!$this->hasDiscount()) {
            return 0;
        }
        
        return (int) (($this->price - $this->discount_price) / $this->price * 100);
    }
    
    /**
     * Get users who favorited this product.
     */
    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }
    
    /**
     * Check if available stock is sufficient
     */
    public function hasStock(int $quantity = 1): bool
    {
        if (!$this->manage_stock) {
            return true;
        }
        
        $availableStock = $this->stock_quantity - $this->reserved_stock;
        return $availableStock >= $quantity;
    }
    
    /**
     * Get available stock (total - reserved)
     */
    public function getAvailableStockAttribute(): int
    {
        if (!$this->manage_stock) {
            return 999999; // Unlimited
        }
        
        return $this->stock_quantity - $this->reserved_stock;
    }
    
    /**
     * Check if stock is low
     */
    public function isLowStock(): bool
    {
        if (!$this->manage_stock) {
            return false;
        }
        
        return $this->stock_quantity <= $this->low_stock_threshold;
    }
    
    /**
     * Reserve stock
     */
    public function reserveStock(int $quantity): bool
    {
        if (!$this->hasStock($quantity)) {
            return false;
        }
        
        $this->increment('reserved_stock', $quantity);
        return true;
    }
    
    /**
     * Release reserved stock
     */
    public function releaseStock(int $quantity): void
    {
        $this->decrement('reserved_stock', $quantity);
        $this->reserved_stock = max(0, $this->reserved_stock);
        $this->save();
    }
}
