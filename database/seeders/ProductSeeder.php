<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Тестовый продукт 1',
                'price' => 1000,
                'image' => 'product-1.jpg',
                'is_new' => true,
                'is_sale' => false,
            ],
            [
                'name' => 'Тестовый продукт 2',
                'price' => 1200,
                'image' => 'product-2.jpg',
                'is_new' => false,
                'is_sale' => true,
            ],
            [
                'name' => 'Тестовый продукт 3',
                'price' => 1400,
                'image' => 'product-3.jpg',
                'is_new' => true,
                'is_sale' => false,
            ],
            [
                'name' => 'Тестовый продукт 4',
                'price' => 1600,
                'image' => 'product-4.jpg',
                'is_new' => false,
                'is_sale' => true,
            ],
            [
                'name' => 'Тестовый продукт 5',
                'price' => 1800,
                'image' => 'product-5.jpg',
                'is_new' => true,
                'is_sale' => true,
            ],
            [
                'name' => 'Тестовый продукт 6',
                'price' => 2000,
                'image' => 'product-6.jpg',
                'is_new' => false,
                'is_sale' => true,
            ],
            [
                'name' => 'Тестовый продукт 7',
                'price' => 2200,
                'image' => 'product-7.jpg',
                'is_new' => true,
                'is_sale' => false,
            ],
            [
                'name' => 'Тестовый продукт 8',
                'price' => 2400,
                'image' => 'product-8.jpg',
                'is_new' => false,
                'is_sale' => true,
            ],
            [
                'name' => 'Тестовый продукт 9',
                'price' => 2600,
                'image' => 'product-9.jpg',
                'is_new' => true,
                'is_sale' => true,
            ],
            [
                'name' => 'Тестовый продукт 10',
                'price' => 2800,
                'image' => 'product-10.jpg',
                'is_new' => true,
                'is_sale' => false,
            ],
            [
                'name' => 'Тестовый продукт 11',
                'price' => 3000,
                'image' => 'product-11.jpg',
                'is_new' => false,
                'is_sale' => true,
            ],
            [
                'name' => 'Тестовый продукт 12',
                'price' => 3200,
                'image' => 'product-12.jpg',
                'is_new' => true,
                'is_sale' => false,
            ],
            [
                'name' => 'Тестовый продукт 13',
                'price' => 3400,
                'image' => 'product-13.jpg',
                'is_new' => false,
                'is_sale' => true,
            ],
            [
                'name' => 'Тестовый продукт 14',
                'price' => 3600,
                'image' => 'product-14.jpg',
                'is_new' => true,
                'is_sale' => false,
            ],
            [
                'name' => 'Тестовый продукт 15',
                'price' => 3800,
                'image' => 'product-15.jpg',
                'is_new' => true,
                'is_sale' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
