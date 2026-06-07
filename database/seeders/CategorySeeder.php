<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Jeans', 'slug' => 'jean', 'description' => 'Stylish jeans for all occasions', 'status' => true],
            ['name' => 'T-Shirts', 'slug' => 't-shirt', 'description' => 'Comfortable t-shirts', 'status' => true],
            ['name' => 'Shoes', 'slug' => 'shoes', 'description' => 'Trendy footwear', 'status' => true],
            ['name' => 'Tops', 'slug' => 'top', 'description' => 'Fashionable tops', 'status' => true],
            ['name' => 'Blouses', 'slug' => 'blouse', 'description' => 'Elegant blouses', 'status' => true],
            ['name' => 'Dresses', 'slug' => 'dress', 'description' => 'Beautiful dresses', 'status' => true],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
        
        $this->command->info('✓ Categories seeded successfully!');
    }
}