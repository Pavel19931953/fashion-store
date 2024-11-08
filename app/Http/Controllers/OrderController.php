<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Валидация данных формы
        $validated = $request->validate([
            'surname' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'delivery_method' => 'required|in:pickup,courier',
            'payment_method' => 'required|in:cash,card',
            'city' => 'required_if:delivery_method,courier|string|max:255',
            'street' => 'required_if:delivery_method,courier|string|max:255',
            'home' => 'required_if:delivery_method,courier|string|max:10',
        ]);

        // Расчет полной стоимости заказа
        $totalPrice = $this->calculateTotalPrice($request);

        try {
            // Создание заказа в базе данных
            $order = Order::create([
                'surname' => $request->surname,
                'name' => $request->name,
                'thirdName' => $request->thirdName,
                'phone' => $request->phone,
                'email' => $request->email,
                'delivery_method' => $request->delivery_method,
                'city' => $request->city,
                'street' => $request->street,
                'home' => $request->home,
                'apartment' => $request->apartment,
                'payment_method' => $request->payment_method,
                'comment' => $request->comment,
                'total_price' => $totalPrice,
            ]);

            // Проверка сохранения данных
           // dd('Order created successfully', $order);

        } catch (\Exception $e) {
            // Если произошла ошибка при сохранении, возвращаем на форму с сообщением об ошибке и описанием исключения
            return back()->with('status', 'Order not saved due to database error: ' . $e->getMessage());
        }

        // Перенаправление на страницу успешного оформления, если все прошло успешно
        return redirect()->route('order.success');
    }

    private function calculateTotalPrice(Request $request)
    {
        $basePrice = 2000;
        $deliveryCost = config('shop.delivery_cost', 280); // Стоимость доставки
        $minFreeDelivery = config('shop.min_order_price_for_free_delivery', 2000); // Порог бесплатной доставки

        // Логика добавления доставки к цене, если не достигнут минимум для бесплатной доставки
        return ($request->delivery_method === 'courier' && $basePrice < $minFreeDelivery)
            ? $basePrice + $deliveryCost
            : $basePrice;
    }

    public function success()
    {
        return view('order.success');
    }

}
