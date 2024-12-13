<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;


Route::get('/', function () {
    return redirect()->route('catalog.index');
})->name('home');

// Группа маршрутов для основной части сайта
Route::group([], function () {  // Заменили 'Route::group(function () {'
    Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
    Route::get('/catalog/novinki', [CatalogController::class, 'novinki'])->name('catalog.novinki');
    Route::get('/catalog/rasprodazha', [CatalogController::class, 'rasprodazha'])->name('catalog.rasprodazha');
    Route::get('catalog/delivery', function () {
        return view('shop.delivery');
    })->name('catalog.delivery');

    Route::post('catalog/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/catalog/order/success', [OrderController::class, 'success'])->name('order.success');
});




// Маршруты авторизации для админского раздела
Route::prefix('admin')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware(['auth', 'admin'])->group(function () {
        // Главная страница админки (список товаров)
        Route::get('/', [ProductController::class, 'index'])->name('admin.dashboard');

        // Маршруты для управления товарами
        Route::prefix('products')->group(function () {
            Route::get('/create', [ProductController::class, 'create'])->name('admin.products.create'); // Добавление товара
            Route::post('/', [ProductController::class, 'store'])->name('admin.products.store'); // Сохранение товара
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
Route::post('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
            Route::delete('/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy'); // Удаление товара
        });
    });
});


Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('admin.login');
})->name('logout');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index'); // Список заказов
    Route::post('/orders/{order}/process', [AdminOrderController::class, 'process'])->name('admin.orders.process'); // Обработка заказа
});
