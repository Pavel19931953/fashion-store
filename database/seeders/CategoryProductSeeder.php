<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class CategoryProductSeeder extends Seeder
{
    public function run()
    {
        // Получаем все категории и продукты
        $categories = Category::all();
        $products = Product::all();

        foreach ($products as $product) {
            // Присваиваем каждой продукции случайные категории
            $randomCategories = $categories->random(rand(2, 5)); // Выбираем от 1 до 3 случайных категорий
            $product->categories()->attach($randomCategories);
        }
    }
}
