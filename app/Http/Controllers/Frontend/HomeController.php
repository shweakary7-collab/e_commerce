<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
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
        
        // Get categories from Category model or use default
        $categories = $this->getCategories();
        
        return view('frontend.home', compact('products', 'categories', 'category'));
    }
    
    public function category($category)
    {
        $products = Product::where('category', $category)
            ->where('is_active', true)
            ->latest()
            ->paginate(12);
        
        $categories = $this->getCategories();
        $currentCategory = $category;
        
        return view('frontend.category', compact('products', 'categories', 'currentCategory'));
    }
    
    private function getCategories()
    {
        return [
            'all' => 'All Products',
            'jean' => 'Jeans',
            't-shirt' => 'T-Shirts',
            'shoes' => 'Shoes',
            'top' => 'Tops',
            'blouse' => 'Blouses',
            'dress' => 'Dresses',
        ];
    }
}