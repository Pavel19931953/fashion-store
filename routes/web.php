<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Главная страница редиректится на каталог
// Группа маршрутов с использованием middleware `web`
Route::middleware('web')->group(function () {
    Route::get('/', function () {
        return redirect()->route('catalog.index');
    })->name('home');

    // Основная страница каталога
    Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');

    // Страница новинок
    Route::get('/catalog/novinki', [CatalogController::class, 'novinki'])->name('catalog.novinki');

    // Страница распродажи
    Route::get('/catalog/rasprodazha', [CatalogController::class, 'rasprodazha'])->name('catalog.rasprodazha');

    // Страница доставки
    Route::get('catalog/delivery', function () {
        return view('shop.delivery');
    })->name('catalog.delivery');

    // Маршрут для создания заказа
    Route::post('catalog/order', [OrderController::class, 'store'])->name('order.store');

    // Маршрут для успешного оформления заказа
    Route::get('/catalog/order/success', [OrderController::class, 'success'])->name('order.success');
});
