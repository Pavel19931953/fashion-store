
@extends('layouts.app')

@section('title', 'Заказ оформлен')

@section('content')
    <div class="container">
        <h2>Спасибо за заказ!</h2>
        <p>Ваш заказ успешно оформлен. Мы свяжемся с вами в ближайшее время.</p>
        <a href="{{ route('catalog.index') }}" class="button">Продолжить покупки</a>
    </div>
@endsection

