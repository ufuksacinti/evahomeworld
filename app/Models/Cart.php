<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'session_id',
        'user_id',
        'total',
        'item_count',
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    /**
     * Get the cart items for the cart.
     */
    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class)->orderBy('created_at');
    }

    /**
     * Get the user that owns the cart.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Calculate total
     */
    public function calculateTotal(): float
    {
        $total = $this->items()->sum('subtotal');
        $this->update([
            'total' => $total,
            'item_count' => $this->items()->sum('quantity'),
        ]);
        return $total;
    }
}
