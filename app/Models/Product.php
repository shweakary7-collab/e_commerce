<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'category',
        'image',
        'stock',
        'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'stock' => 'integer'
    ];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/no-image.png');
    }

    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Categories static list
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
            'accessories' => 'Accessories'
        ];
    }
}