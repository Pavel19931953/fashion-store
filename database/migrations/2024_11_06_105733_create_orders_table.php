<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('surname'); // Фамилия
            $table->string('name'); // Имя
            $table->string('thirdName')->nullable(); // Отчество
            $table->string('phone'); // Телефон
            $table->string('email'); // Email
            $table->enum('delivery_method', ['pickup', 'courier']); // Метод доставки
            $table->string('city')->nullable(); // Город (только для курьерской доставки)
            $table->string('street')->nullable(); // Улица (только для курьерской доставки)
            $table->string('home')->nullable(); // Дом (только для курьерской доставки)
            $table->string('apartment')->nullable(); // Квартира (только для курьерской доставки)
            $table->enum('payment_method', ['cash', 'card']); // Метод оплаты
            $table->text('comment')->nullable(); // Комментарий к заказу
            $table->decimal('total_price', 8, 2); // Общая стоимость заказа
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
