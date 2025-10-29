<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'discount_percentage',
        'start_date',
        'end_date',
        'is_active',
        'image',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function products()
    {
        return $this->belongsToMany(Product::class, 'campaign_products');
    }

    // Helper methods
    public function isActive()
    {
        if (!$this->is_active) {
            return false;
        }

        $now = Carbon::now();
        return $now->between($this->start_date, $this->end_date);
    }

    public function hasStarted()
    {
        return Carbon::now()->gte($this->start_date);
    }

    public function hasEnded()
    {
        return Carbon::now()->gt($this->end_date);
    }
}
