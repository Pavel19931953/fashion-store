<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CatalogController extends Controller
{
    /**
     * Отображение основного каталога товаров с фильтрацией, сортировкой и пагинацией.
     */
    public function index(Request $request)
    {

        //dd(Category::all());
        $query = Product::query();
        // Фильтрация по категории
        if ($request->has('category') && $request->input('category') !== 'Все') {
            $category = Category::where('name', $request->input('category'))->first();
            if ($category) {
                $query->whereHas('categories', function ($q) use ($category) {
                    $q->where('category_id', $category->id);
                });
            }
        }

        // Фильтрация по диапазону цен
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->whereBetween('price', [$request->input('min_price'), $request->input('max_price')]);
        }

        // Фильтрация по признаку "Новинка"
        if ($request->has('is_new')) {
            $query->where('is_new', true);
        }

        // Фильтрация по признаку "Распродажа"
        if ($request->has('is_sale')) {
            $query->where('is_sale', true);
        }

        // Сортировка
        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by');
            $order = $request->input('order', 'asc');
            $query->orderBy($sortBy, $order);
        }

        // Пагинация
        $products = $query->paginate(9);

        // Получаем все категории для меню категорий
        $categories = Category::all();



        //dd(compact('products', 'categories'));
        return view('shop.index', compact('products', 'categories'));
    }

    /**
     * Отображение страницы "Новинки" с включенным фильтром "Новинка".
     */
    public function novinki(Request $request)
    {
        $query = Product::where('is_new', true);
        $this->applyFilters($query, $request);

        $products = $query->paginate(9);
        $categories = Category::all();
        //dd(compact('products', 'categories'));

        return view('shop.index', compact('products', 'categories'))->with('title', 'Новинки');
    }

    /**
     * Отображение страницы "Распродажа" с включенным фильтром "Распродажа".
     */
    public function rasprodazha(Request $request)
    {


        $query = Product::where('is_sale', true);
        $this->applyFilters($query, $request);

        $products = $query->paginate(9);
        $categories = Category::all();
        //dd($categories);
        return view('shop.index', compact('products', 'categories'))->with('title', 'Распродажа');
    }

    /**
     * Вспомогательный метод для применения фильтров и сортировки.
     */
    private function applyFilters($query, Request $request)
    {
        // Фильтрация по категории
        if ($request->has('category') && $request->input('category') !== 'Все') {
            $category = Category::where('name', $request->input('category'))->first();
            if ($category) {
                $query->whereHas('categories', function ($q) use ($category) {
                    $q->where('category_id', $category->id);
                });
            }
        }

        // Фильтрация по диапазону цен
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->whereBetween('price', [$request->input('min_price'), $request->input('max_price')]);
        }

        // Сортировка
        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by');
            $order = $request->input('order', 'asc');
            $query->orderBy($sortBy, $order);
        }
    }
}
