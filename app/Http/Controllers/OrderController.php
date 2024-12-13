<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        //dd('Entering store method');

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
        //dd($validated);

        $totalPrice = $this->calculateTotalPrice($request);

        try {

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


           // dd('Order created successfully', $order);

        } catch (\Exception $e) {

            return back()->with('status', 'Order not saved due to database error: ' . $e->getMessage());
        }


        return redirect()->route('order.success');
    }

    private function calculateTotalPrice(Request $request)
    {
        $basePrice = 2000;
        $deliveryCost = config('shop.delivery_cost', 280);
        $minFreeDelivery = config('shop.min_order_price_for_free_delivery', 2000);


        return ($request->delivery_method === 'courier' && $basePrice < $minFreeDelivery)
            ? $basePrice + $deliveryCost
            : $basePrice;
    }

    public function success()
    {
        return view('order.success');
    }

}
