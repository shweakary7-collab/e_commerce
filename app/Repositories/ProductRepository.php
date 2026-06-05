<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function getAllProducts()
    {
        return Product::with('category')->where('status', 1)->latest()->get();
    }

    public function getFeaturedProducts($limit = 8)
    {
        return Product::with('category')->where('status', 1)->latest()->take($limit)->get();
    }

    public function getPaginatedProducts($perPage = 12)
    {
        return Product::with('category')->where('status', 1)->latest()->paginate($perPage);
    }

    public function getProductsByCategory($categoryId, $perPage = 12)
    {
        return Product::with('category')
            ->where('category_id', $categoryId)
            ->where('status', 1)
            ->latest()
            ->paginate($perPage);
    }

    public function getProductBySlug($slug)
    {
        return Product::with('category')->where('slug', $slug)->firstOrFail();
    }

    public function getRelatedProducts($productId, $categoryId, $limit = 4)
    {
        return Product::where('category_id', $categoryId)
            ->where('id', '!=', $productId)
            ->where('status', 1)
            ->limit($limit)
            ->get();
    }
}