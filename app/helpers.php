<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Session;

if (!function_exists('currentCart')) {
    /**
     * Get or create current cart
     */
    function currentCart()
    {
        $sessionId = Session::getId();
        $userId = auth()->id();
        
        // Kullanıcı giriş yapmışsa kullanıcının sepetini bul
        if ($userId) {
            // Önce kullanıcının aktif sepetini ara
            $cart = Cart::where('user_id', $userId)
                ->whereNull('deleted_at')
                ->first();
            
            // Eğer session sepeti varsa, kullanıcıya taşı
            if (!$cart) {
                $sessionCart = Cart::where('session_id', $sessionId)
                    ->whereNull('user_id')
                    ->whereNull('deleted_at')
                    ->first();
                
                if ($sessionCart) {
                    $sessionCart->user_id = $userId;
                    $sessionCart->save();
                    $cart = $sessionCart;
                }
            }
            
            // Hala cart yoksa yeni oluştur
            if (!$cart) {
                $cart = Cart::create([
                    'session_id' => $sessionId,
                    'user_id' => $userId,
                    'total' => 0,
                    'item_count' => 0,
                ]);
            }
            
            return $cart;
        }
        
        // Ziyaretçi sepeti
        $cart = Cart::where('session_id', $sessionId)
            ->whereNull('user_id')
            ->whereNull('deleted_at')
            ->first();
        
        if (!$cart) {
            $cart = Cart::create([
                'session_id' => $sessionId,
                'total' => 0,
                'item_count' => 0,
            ]);
        }
        
        return $cart;
    }
}

if (!function_exists('t')) {
    /**
     * Translation helper
     */
    function t($key, $locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        
        $translation = \App\Models\Translation::where('key', $key)->first();
        
        if ($translation) {
            return $translation->{$locale} ?: $translation->tr ?: $key;
        }
        
        return $key;
    }
}
