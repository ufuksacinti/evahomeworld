<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Toggle favorite status for a product
     */
    public function toggle(Request $request, $productId)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Please login to add favorites'], 401);
        }
        
        $user = Auth::user();
        $product = Product::findOrFail($productId);
        
        $favorite = Favorite::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();
        
        if ($favorite) {
            $favorite->delete();
            $isFavorite = false;
            $message = 'Removed from favorites';
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]);
            $isFavorite = true;
            $message = 'Added to favorites';
        }
        
        return response()->json([
            'success' => true,
            'is_favorite' => $isFavorite,
            'message' => $message,
        ]);
    }
    
    /**
     * Get user's favorites
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $user = Auth::user();
        $favorites = $user->favoriteProducts()->paginate(12);
        
        return view('favorites.index', compact('favorites'));
    }
    
    /**
     * Check if product is favorited
     */
    public function check($productId)
    {
        if (!Auth::check()) {
            return response()->json(['is_favorite' => false]);
        }
        
        $user = Auth::user();
        $isFavorite = Favorite::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->exists();
        
        return response()->json(['is_favorite' => $isFavorite]);
    }
}
