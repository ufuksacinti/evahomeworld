<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    // Helper methods
    public function getTotalAmount()
    {
        return $this->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    }

    public function getTotalItems()
    {
        return $this->items->sum('quantity');
    }

    public function addItem(Product $product, $quantity = 1)
    {
        $existingItem = $this->items()->where('product_id', $product->id)->first();

        if ($existingItem) {
            $existingItem->quantity += $quantity;
            $existingItem->save();
            return $existingItem;
        }

        return $this->items()->create([
            'product_id' => $product->id,
            'quantity' => $quantity,
            'price' => $product->getFinalPrice(),
        ]);
    }

    public function removeItem($productId)
    {
        return $this->items()->where('product_id', $productId)->delete();
    }

    public function updateQuantity($productId, $quantity)
    {
        $item = $this->items()->where('product_id', $productId)->first();
        if ($item) {
            $item->quantity = $quantity;
            $item->save();
            return $item;
        }
        return null;
    }

    public function clear()
    {
        return $this->items()->delete();
    }
}
