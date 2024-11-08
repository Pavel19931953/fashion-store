<!-- resources/views/pages/delivery.blade.php -->
@extends('layouts.app')

@section('title', 'Доставка - Fashion')

@section('content')
    <main class="page-delivery">
        <header class="intro">
            <h1 class="intro__title">Доставка</h1>
        </header>

        <p class="page-delivery__desc">
            Способы доставки могут изменяться в зависимости от адреса доставки, времени осуществления покупки и наличия товаров.
        </p>
        <p class="page-delivery__desc page-delivery__desc--strong">
            <b>При оформлении покупки мы проинформируем вас о доступных способах доставки, стоимости и дате доставки вашего заказа.</b>
        </p>

        <section class="page-delivery__info">
            <header class="page-delivery__desc">
                Возможные варианты доставки:
                <b class="page-delivery__variant">Доставка на дом:</b>
            </header>
            <ul class="page-delivery__list">
                <li>
                    <b class="page-delivery__item-title">Стандартная доставка - 150 грн / БЕСПЛАТНО (ДЛЯ ЗАКАЗОВ ОТ 2000 грн)</b>
                    <p class="page-delivery__item-desc">
                        Примерный срок доставки составит около 2-7 рабочих дней, в зависимости от адреса доставки.
                    </p>
                </li>
                <li>
                    <b class="page-delivery__item-title">В день покупки - 560 грн</b>
                    <p class="page-delivery__item-desc">
                        Доступна для жителей г. Ирпень  Заказы, оформленные с понедельника по пятницу до 14:00, будут доставлены в тот же день с 19:00 до 23:00. Изменение адреса доставки после оформления заказа невозможно.
                    </p>
                </li>
                <li>
                    <b class="page-delivery__item-title">Доставка с примеркой перед покупкой по Киеву - 200 грн / БЕСПЛАТНО (ПРИ ВЫКУПЕ НА СУММУ ОТ 2000 грн)</b>
                    <p class="page-delivery__item-desc">
                        Доставка возможна только по Киеву в течение 2-3 дней. При «Примерке перед покупкой» можно получить заказ и примерить товары. Оплата только за выбранные вещи. Максимум 10 вещей, время на примерку – 15 минут.
                    </p>
                </li>
            </ul>
            <p class="page-delivery__desc">
                Мы свяжемся с вами, чтобы подтвердить дату и время доставки. Также вы получите уведомления по электронной почте и SMS с информацией о заказе, стоимости и готовности к выдаче. В день доставки отправим SMS с номером телефона курьера.
            </p>
            <a class="page-delivery__button button" href="{{ route('home') }}">Продолжить покупки</a>
        </section>
    </main>
@endsection

