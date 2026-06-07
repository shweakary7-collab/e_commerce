<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category', 'all');
        
        $query = Product::where('is_active', true);
        
        if ($category !== 'all') {
            $query->where('category', $category);
        }
        
        $products = $query->latest()->paginate(12);
        $categories = Product::getCategories();
        
        return view('frontend.home', compact('products', 'categories', 'category'));
    }
}