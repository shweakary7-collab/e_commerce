<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $recentOrders = Order::with('user')->latest()->take(5)->get();
        $totalRevenue = null;
        $totalUsers = null;
        
        if ($user->hasRole('admin')) {
            $totalRevenue = Order::sum('total_amount');
            $totalUsers = User::where('is_admin', false)->count();
        }
        
        return view('backend.dashboard', compact(
            'totalProducts', 
            'totalOrders', 
            'totalRevenue', 
            'totalUsers', 
            'recentOrders'
        ));
    }
}