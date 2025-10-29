<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display cart
     */
    public function index()
    {
        $cart = currentCart();
        $items = $cart->items()->with('product')->get();
        
        return view('cart.index', compact('cart', 'items'));
    }
    
    /**
     * Add item to cart
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
        
        $product = Product::findOrFail($request->product_id);
        
        // Stock kontrolü
        if (!$product->hasStock($request->quantity)) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient stock',
            ], 400);
        }
        
        $cart = currentCart();
        
        // Ürün sepette var mı kontrol et
        $cartItem = $cart->items()->where('product_id', $request->product_id)->first();
        
        if ($cartItem) {
            // Miktarı güncelle
            $newQuantity = $cartItem->quantity + $request->quantity;
            
            if (!$product->hasStock($newQuantity - $cartItem->quantity)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient stock',
                ], 400);
            }
            
            $cartItem->quantity = $newQuantity;
            $cartItem->price = $product->finalPrice();
            $cartItem->subtotal = $cartItem->price * $cartItem->quantity;
            $cartItem->save();
        } else {
            // Yeni ürün ekle
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $product->finalPrice(),
                'subtotal' => $product->finalPrice() * $request->quantity,
            ]);
        }
        
        // Stok rezerve et
        $product->reserveStock($request->quantity);
        
        // Sepeti güncelle
        $cart->calculateTotal();
        
        return response()->json([
            'success' => true,
            'message' => 'Product added to cart',
            'cart_count' => $cart->item_count,
        ]);
    }
    
    /**
     * Update cart item
     */
    public function update(Request $request, $itemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        
        $cart = currentCart();
        $cartItem = $cart->items()->findOrFail($itemId);
        $product = $cartItem->product;
        
        $quantityDifference = $request->quantity - $cartItem->quantity;
        
        if ($quantityDifference > 0 && !$product->hasStock($quantityDifference)) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient stock',
            ], 400);
        }
        
        // Stok rezervasyonunu güncelle
        if ($quantityDifference > 0) {
            $product->reserveStock($quantityDifference);
        } else {
            $product->releaseStock(abs($quantityDifference));
        }
        
        $cartItem->quantity = $request->quantity;
        $cartItem->subtotal = $cartItem->price * $request->quantity;
        $cartItem->save();
        
        $cart->calculateTotal();
        
        return response()->json([
            'success' => true,
            'message' => 'Cart updated',
            'item_subtotal' => $cartItem->subtotal,
            'cart_total' => $cart->total,
        ]);
    }
    
    /**
     * Remove item from cart
     */
    public function remove($itemId)
    {
        $cart = currentCart();
        $cartItem = $cart->items()->findOrFail($itemId);
        $product = $cartItem->product;
        
        // Rezerve edilmiş stoğu serbest bırak
        $product->releaseStock($cartItem->quantity);
        
        $cartItem->delete();
        
        $cart->calculateTotal();
        
        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart',
            'cart_total' => $cart->total,
            'cart_count' => $cart->item_count,
        ]);
    }
    
    /**
     * Get cart count
     */
    public function count()
    {
        $cart = currentCart();
        return response()->json(['count' => $cart->item_count]);
    }
    
    /**
     * Clear cart
     */
    public function clear()
    {
        $cart = currentCart();
        
        // Rezerve edilmiş stoğu serbest bırak
        foreach ($cart->items as $item) {
            $item->product->releaseStock($item->quantity);
        }
        
        $cart->items()->delete();
        $cart->calculateTotal();
        
        return response()->json([
            'success' => true,
            'message' => 'Cart cleared',
        ]);
    }
}
