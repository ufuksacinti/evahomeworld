<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $fillable = [
        'key',
        'tr',
        'en',
        'group',
    ];

    /**
     * Get translation for current language
     */
    public static function get($key, $locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        $translation = self::where('key', $key)->first();
        
        if (!$translation) {
            return $key; // Return key if translation not found
        }
        
        return $translation->{$locale} ?? $translation->tr ?? $key;
    }
}
