<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $sessionId = Session::getId();
        $cartItems = Cart::with('product')
            ->where('session_id', $sessionId)
            ->get();
        
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
        $sessionId = Session::getId();
        
        $cartItem = Cart::where('session_id', $sessionId)
            ->where('product_id', $product->id)
            ->first();
        
        if ($cartItem) {
            $cartItem->quantity += $request->quantity ?? 1;
            $cartItem->save();
        } else {
            Cart::create([
                'session_id' => $sessionId,
                'product_id' => $product->id,
                'quantity' => $request->quantity ?? 1
            ]);
        }
        
        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        
        $sessionId = Session::getId();
        $cartItem = Cart::where('session_id', $sessionId)
            ->where('id', $id)
            ->firstOrFail();
        
        $cartItem->update(['quantity' => $request->quantity]);
        
        return redirect()->back()->with('success', 'Cart updated!');
    }

    public function remove($id)
    {
        $sessionId = Session::getId();
        $cartItem = Cart::where('session_id', $sessionId)
            ->where('id', $id)
            ->firstOrFail();
        
        $cartItem->delete();
        
        return redirect()->back()->with('success', 'Item removed from cart!');
    }
}