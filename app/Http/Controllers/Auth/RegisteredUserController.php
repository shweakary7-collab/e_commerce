<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        // Get the old session ID BEFORE creating user (this is the guest session)
        $oldSessionId = Session::getId();
        
        // Get cart items from old session
        $sessionCartItems = Cart::where('session_id', $oldSessionId)
            ->whereNull('user_id')
            ->get();
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => false,
        ]);

        $user->assignRole('customer');
        event(new Registered($user));

        Auth::login($user);

        // Merge session cart to user cart after registration
        $this->mergeCartAfterRegistration($sessionCartItems);

        return redirect(route('home'))->with('success', 'Registration successful! Welcome ' . $user->name);
    }
    
    protected function mergeCartAfterRegistration($sessionCartItems): void
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