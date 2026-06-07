<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        
        // Merge session cart to user cart
        $this->mergeCartAfterLogin();
        
        $request->session()->regenerate();

        // Redirect to home page
        return redirect()->intended(route('home'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Merge session cart to user cart after login
     */
    protected function mergeCartAfterLogin(): void
    {
        $sessionId = Session::getId();
        $userId = Auth::id();
        
        // Get session cart items
        $sessionCartItems = Cart::where('session_id', $sessionId)->get();
        
        if ($sessionCartItems->isNotEmpty()) {
            foreach ($sessionCartItems as $sessionItem) {
                // Check if product already exists in user's cart
                $existingCartItem = Cart::where('user_id', $userId)
                    ->where('product_id', $sessionItem->product_id)
                    ->first();
                
                if ($existingCartItem) {
                    // Update quantity if product already exists
                    $existingCartItem->quantity += $sessionItem->quantity;
                    $existingCartItem->save();
                } else {
                    // Create new cart item for user
                    $sessionItem->user_id = $userId;
                    $sessionItem->session_id = null;
                    $sessionItem->save();
                }
            }
            
            // Delete remaining session cart items (without user_id)
            Cart::where('session_id', $sessionId)->whereNull('user_id')->delete();
        }
    }
}