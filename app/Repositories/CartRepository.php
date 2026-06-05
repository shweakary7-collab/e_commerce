<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Product;

class CartRepository
{
    public function getCartItems($sessionId)
    {
        return Cart::where('session_id', $sessionId)
            ->orWhere('user_id', auth()->id())
            ->get();
    }

    public function getCartSubtotal($sessionId)
    {
        $items = $this->getCartItems($sessionId);
        return $items->sum(function($item) {
            return $item->product_price * $item->quantity;
        });
    }

    public function addToCart($sessionId, $productId, $quantity = 1)
    {
        $product = Product::findOrFail($productId);
        
        $cartItem = Cart::where('session_id', $sessionId)
            ->where('product_id', $productId)
            ->first();
            
        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
            return $cartItem;
        }
        
        return Cart::create([
            'session_id' => $sessionId,
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'product_name' => $product->name,
            'product_image' => $product->image,
            'product_price' => $product->price,
            'quantity' => $quantity
        ]);
    }

    public function updateCartItem($cartId, $quantity)
    {
        $cartItem = Cart::findOrFail($cartId);
        $cartItem->quantity = $quantity;
        $cartItem->save();
        return $cartItem;
    }

    public function removeCartItem($cartId)
    {
        $cartItem = Cart::findOrFail($cartId);
        $cartItem->delete();
        return true;
    }

    public function clearCart($sessionId)
    {
        return Cart::where('session_id', $sessionId)->delete();
    }
}
