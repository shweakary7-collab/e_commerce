<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'price', 
        'category', 'image', 'stock', 'is_active'
    ];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return 'https://via.placeholder.com/300x200?text=No+Image';
    }

    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function getCategories()
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