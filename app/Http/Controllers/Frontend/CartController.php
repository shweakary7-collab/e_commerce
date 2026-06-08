<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = $this->getCartItems();
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
        
        return view('frontend.cart', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity ?? 1;
        
        if (Auth::check()) {
            // User is logged in - save to user cart
            $cartItem = Cart::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->first();
            
            if ($cartItem) {
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'quantity' => $quantity
                ]);
            }
        } else {
            // User is not logged in - save to session cart
            $sessionId = Session::getId();
            $cartItem = Cart::where('session_id', $sessionId)
                ->where('product_id', $product->id)
                ->first();
            
            if ($cartItem) {
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                Cart::create([
                    'session_id' => $sessionId,
                    'product_id' => $product->id,
                    'quantity' => $quantity
                ]);
            }
        }
        
        // Remove the problematic line - no need for getCartCount()
        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        
        $cartItem = $this->getCartItemById($id);
        
        if ($cartItem) {
            $cartItem->update(['quantity' => $request->quantity]);
            return redirect()->back()->with('success', 'Cart updated!');
        }
        
        return redirect()->back()->with('error', 'Cart item not found!');
    }

    public function remove($id)
    {
        $cartItem = $this->getCartItemById($id);
        
        if ($cartItem) {
            $cartItem->delete();
            return redirect()->back()->with('success', 'Item removed from cart!');
        }
        
        return redirect()->back()->with('error', 'Cart item not found!');
    }

    /**
     * Get cart items based on user login status
     */
    protected function getCartItems()
    {
        if (Auth::check()) {
            return Cart::with('product')
                ->where('user_id', Auth::id())
                ->get();
        } else {
            return Cart::with('product')
                ->where('session_id', Session::getId())
                ->get();
        }
    }

    /**
     * Get cart item by ID based on user login status
     */
    protected function getCartItemById($id)
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::id())
                ->where('id', $id)
                ->first();
        } else {
            return Cart::where('session_id', Session::getId())
                ->where('id', $id)
                ->first();
        }
    }
}