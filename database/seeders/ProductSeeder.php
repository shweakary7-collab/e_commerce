<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Jeans Category (6 products)
            [
                'name' => 'Classic Blue Jeans',
                'slug' => 'classic-blue-jeans',
                'description' => 'Comfortable classic blue jeans made from premium cotton denim. Perfect for everyday wear.',
                'price' => 69000,
                'category' => 'jean',
                'stock' => 25,
                'is_active' => true,
            ],
            [
                'name' => 'Black Slim Fit Jeans',
                'slug' => 'black-slim-fit-jeans',
                'description' => 'Elegant black slim fit jeans with stretchable fabric for maximum comfort.',
                'price' => 79000,
                'category' => 'jean',
                'stock' => 20,
                'is_active' => true,
            ],
            [
                'name' => 'Light Wash Jeans',
                'slug' => 'light-wash-jeans',
                'description' => 'Trendy light wash jeans with distressed details for a vintage look.',
                'price' => 65000,
                'category' => 'jean',
                'stock' => 15,
                'is_active' => true,
            ],
            [
                'name' => 'White Jeans',
                'slug' => 'white-jeans',
                'description' => 'Clean white jeans perfect for summer outfits.',
                'price' => 72000,
                'category' => 'jean',
                'stock' => 12,
                'is_active' => true,
            ],
            [
                'name' => 'Ripped Jeans',
                'slug' => 'ripped-jeans',
                'description' => 'Fashionable ripped jeans with stylish distressed knees.',
                'price' => 85000,
                'category' => 'jean',
                'stock' => 18,
                'is_active' => true,
            ],
            [
                'name' => 'Baggy Jeans',
                'slug' => 'baggy-jeans',
                'description' => 'Comfortable baggy fit jeans with relaxed style.',
                'price' => 75000,
                'category' => 'jean',
                'stock' => 10,
                'is_active' => true,
            ],

            // T-Shirts Category (6 products)
            [
                'name' => 'Plain White T-Shirt',
                'slug' => 'plain-white-t-shirt',
                'description' => 'Essential plain white cotton t-shirt. Soft and breathable fabric.',
                'price' => 25000,
                'category' => 't-shirt',
                'stock' => 50,
                'is_active' => true,
            ],
            [
                'name' => 'Black Graphic T-Shirt',
                'slug' => 'black-graphic-t-shirt',
                'description' => 'Cool black t-shirt with artistic graphic print.',
                'price' => 35000,
                'category' => 't-shirt',
                'stock' => 40,
                'is_active' => true,
            ],
            [
                'name' => 'Striped Cotton T-Shirt',
                'slug' => 'striped-cotton-t-shirt',
                'description' => 'Classic striped pattern t-shirt made from 100% cotton.',
                'price' => 30000,
                'category' => 't-shirt',
                'stock' => 35,
                'is_active' => true,
            ],
            [
                'name' => 'V-Neck T-Shirt',
                'slug' => 'v-neck-t-shirt',
                'description' => 'Elegant v-neck t-shirt available in multiple colors.',
                'price' => 28000,
                'category' => 't-shirt',
                'stock' => 45,
                'is_active' => true,
            ],
            [
                'name' => 'Polo T-Shirt',
                'slug' => 'polo-t-shirt',
                'description' => 'Classic polo t-shirt with collar and button design.',
                'price' => 45000,
                'category' => 't-shirt',
                'stock' => 30,
                'is_active' => true,
            ],
            [
                'name' => 'Oversized T-Shirt',
                'slug' => 'oversized-t-shirt',
                'description' => 'Trendy oversized fit t-shirt for relaxed look.',
                'price' => 32000,
                'category' => 't-shirt',
                'stock' => 38,
                'is_active' => true,
            ],

            // Shoes Category (6 products)
            [
                'name' => 'Classic Sneakers',
                'slug' => 'classic-sneakers',
                'description' => 'Comfortable white sneakers perfect for daily wear.',
                'price' => 89000,
                'category' => 'shoes',
                'stock' => 20,
                'is_active' => true,
            ],
            [
                'name' => 'Running Shoes',
                'slug' => 'running-shoes',
                'description' => 'Professional running shoes with cushioned sole.',
                'price' => 120000,
                'category' => 'shoes',
                'stock' => 15,
                'is_active' => true,
            ],
            [
                'name' => 'Leather Loafers',
                'slug' => 'leather-loafers',
                'description' => 'Elegant leather loafers for formal occasions.',
                'price' => 95000,
                'category' => 'shoes',
                'stock' => 12,
                'is_active' => true,
            ],
            [
                'name' => 'Sport Sandals',
                'slug' => 'sport-sandals',
                'description' => 'Comfortable sport sandals for summer activities.',
                'price' => 55000,
                'category' => 'shoes',
                'stock' => 25,
                'is_active' => true,
            ],
            [
                'name' => 'High Top Sneakers',
                'slug' => 'high-top-sneakers',
                'description' => 'Stylish high top sneakers with ankle support.',
                'price' => 105000,
                'category' => 'shoes',
                'stock' => 18,
                'is_active' => true,
            ],
            [
                'name' => 'Casual Boots',
                'slug' => 'casual-boots',
                'description' => 'Durable casual boots for outdoor activities.',
                'price' => 135000,
                'category' => 'shoes',
                'stock' => 10,
                'is_active' => true,
            ],

            // Tops Category (6 products)
            [
                'name' => 'Silk Blouse Top',
                'slug' => 'silk-blouse-top',
                'description' => 'Elegant silk blouse top with beautiful design.',
                'price' => 58000,
                'category' => 'top',
                'stock' => 15,
                'is_active' => true,
            ],
            [
                'name' => 'Casual Crop Top',
                'slug' => 'casual-crop-top',
                'description' => 'Trendy crop top perfect for summer outfits.',
                'price' => 29000,
                'category' => 'top',
                'stock' => 30,
                'is_active' => true,
            ],
            [
                'name' => 'Off Shoulder Top',
                'slug' => 'off-shoulder-top',
                'description' => 'Stylish off shoulder top for evening parties.',
                'price' => 49000,
                'category' => 'top',
                'stock' => 20,
                'is_active' => true,
            ],
            [
                'name' => 'Lace Top',
                'slug' => 'lace-top',
                'description' => 'Beautiful lace detailed top for special occasions.',
                'price' => 65000,
                'category' => 'top',
                'stock' => 12,
                'is_active' => true,
            ],
            [
                'name' => 'Turtleneck Top',
                'slug' => 'turtleneck-top',
                'description' => 'Warm and stylish turtleneck top for winter.',
                'price' => 42000,
                'category' => 'top',
                'stock' => 25,
                'is_active' => true,
            ],
            [
                'name' => 'Sleeveless Top',
                'slug' => 'sleeveless-top',
                'description' => 'Light and airy sleeveless top for hot days.',
                'price' => 25000,
                'category' => 'top',
                'stock' => 35,
                'is_active' => true,
            ],

            // Blouses Category (6 products)
            [
                'name' => 'Cotton Blouse',
                'slug' => 'cotton-blouse',
                'description' => 'Soft cotton blouse with button front design.',
                'price' => 38000,
                'category' => 'blouse',
                'stock' => 25,
                'is_active' => true,
            ],
            [
                'name' => 'Floral Blouse',
                'slug' => 'floral-blouse',
                'description' => 'Beautiful floral print blouse for spring.',
                'price' => 45000,
                'category' => 'blouse',
                'stock' => 20,
                'is_active' => true,
            ],
            [
                'name' => 'Silk Blouse',
                'slug' => 'silk-blouse',
                'description' => 'Luxurious silk blouse with elegant design.',
                'price' => 72000,
                'category' => 'blouse',
                'stock' => 10,
                'is_active' => true,
            ],
            [
                'name' => 'Chiffon Blouse',
                'slug' => 'chiffon-blouse',
                'description' => 'Lightweight chiffon blouse with sheer sleeves.',
                'price' => 55000,
                'category' => 'blouse',
                'stock' => 18,
                'is_active' => true,
            ],
            [
                'name' => 'Ruffled Blouse',
                'slug' => 'ruffled-blouse',
                'description' => 'Charming ruffled blouse with feminine details.',
                'price' => 62000,
                'category' => 'blouse',
                'stock' => 14,
                'is_active' => true,
            ],
            [
                'name' => 'Linen Blouse',
                'slug' => 'linen-blouse',
                'description' => 'Breathable linen blouse perfect for summer.',
                'price' => 48000,
                'category' => 'blouse',
                'stock' => 22,
                'is_active' => true,
            ],

            // Dresses Category (6 products)
            [
                'name' => 'Summer Maxi Dress',
                'slug' => 'summer-maxi-dress',
                'description' => 'Beautiful floral maxi dress perfect for summer days.',
                'price' => 89000,
                'category' => 'dress',
                'stock' => 12,
                'is_active' => true,
            ],
            [
                'name' => 'Little Black Dress',
                'slug' => 'little-black-dress',
                'description' => 'Classic little black dress for evening events.',
                'price' => 99000,
                'category' => 'dress',
                'stock' => 15,
                'is_active' => true,
            ],
            [
                'name' => 'Casual Sundress',
                'slug' => 'casual-sundress',
                'description' => 'Light and breezy sundress for casual outings.',
                'price' => 55000,
                'category' => 'dress',
                'stock' => 20,
                'is_active' => true,
            ],
            [
                'name' => 'Formal Evening Dress',
                'slug' => 'formal-evening-dress',
                'description' => 'Elegant evening dress for formal occasions.',
                'price' => 149000,
                'category' => 'dress',
                'stock' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Wrap Dress',
                'slug' => 'wrap-dress',
                'description' => 'Flattering wrap dress suitable for all body types.',
                'price' => 75000,
                'category' => 'dress',
                'stock' => 15,
                'is_active' => true,
            ],
            [
                'name' => 'Shirt Dress',
                'slug' => 'shirt-dress',
                'description' => 'Versatile shirt dress perfect for office or casual.',
                'price' => 68000,
                'category' => 'dress',
                'stock' => 18,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['slug' => $product['slug']],
                $product
            );
        }
        
        $this->command->info('✓ Products seeded successfully!');
        $this->command->info('  Total products: ' . count($products));
        $this->command->info('  - Jeans: 6 products');
        $this->command->info('  - T-Shirts: 6 products');
        $this->command->info('  - Shoes: 6 products');
        $this->command->info('  - Tops: 6 products');
        $this->command->info('  - Blouses: 6 products');
        $this->command->info('  - Dresses: 6 products');
    }
}