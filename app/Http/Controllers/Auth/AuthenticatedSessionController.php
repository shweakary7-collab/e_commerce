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
        // Get the old session ID BEFORE authentication (this is the guest session)
        $oldSessionId = Session::getId();
        
        // Get cart items from old session
        $sessionCartItems = Cart::where('session_id', $oldSessionId)
            ->whereNull('user_id')
            ->get();
        
        $request->authenticate();
        
        // Merge session cart to user cart after login
        $this->mergeCartAfterLogin($sessionCartItems);
        
        $request->session()->regenerate();

        //Role-based redirect using Spatie
        $user = Auth::user();
        if($user->hasRole('admin')) {
            return redirect()->intended(route('admin.dashboard'));
        }
        if($user->hasRole('staff')) {
            return redirect()->intended(route('admin.dashboard'));
        }

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

    protected function mergeCartAfterLogin($sessionCartItems): void
    {
        $userId = Auth::id();
        
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
                    // Delete the session item
                    $sessionItem->delete();
                } else {
                    // Transfer session cart to user cart
                    $sessionItem->user_id = $userId;
                    $sessionItem->session_id = null;
                    $sessionItem->save();
                }
            }
        }
    }
}