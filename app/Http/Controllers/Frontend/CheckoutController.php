<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        $sessionId = Session::getId();
        $cartItems = Cart::with('product')
            ->where('session_id', $sessionId)
            ->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty!');
        }
        
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
        
        return view('frontend.checkout', compact('cartItems', 'total'));
    }

    public function process(Request $request)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login or register to continue checkout');
        }
        
        $sessionId = Session::getId();
        $cartItems = Cart::with('product')
            ->where('session_id', $sessionId)
            ->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty!');
        }
        
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
        
        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => Order::generateOrderNumber(),
            'total_amount' => $total,
            'status' => 'pending',
            'payment_method' => 'cash_on_delivery',
            'shipping_address' => $request->shipping_address ?? 'No address provided'
        ]);
        
        // Create order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ]);
        }
        
        // Clear cart
        Cart::where('session_id', $sessionId)->delete();
        
        return redirect()->route('home')->with('success', 'Order placed successfully! Order #: ' . $order->order_number);
    }
}