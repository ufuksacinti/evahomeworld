<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'type',
        'order',
        'is_active',
        'feeling',
        'color',
        'scent',
        'energy',
        'emotion',
        'element',
        'story',
        'color_hex',
        'visual_feeling',
        'color_description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the products for the collection.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
