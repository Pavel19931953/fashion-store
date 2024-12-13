<!-- resources/views/shop/index.blade.php -->
@extends('layouts.app')

@section('title', 'Главная - Fashion')

@section('content')

    <section class="shop-page">
        <main class="shop-page">
            <header class="intro">
                <div class="intro__wrapper">
                    <h1 class="intro__title">COATS</h1>
                    <p class="intro__info">Collection 2018</p>
                </div>


            </header>


            <section class="shop container">

                <!-- Подключение динамических фильтров из filter.blade.php -->
                @if(isset($categories))
                    @include('partials.filter', ['categories' => $categories])
                @else
                    <p>Категории отсутствуют.</p>
                @endif

                <div class="shop__wrapper">
                    <!-- Секция сортировки -->
                    <section class="shop__sorting">
                        <div class="shop__sorting-item custom-form__select-wrapper">
                            <select class="custom-form__select" name="sort_by" form="filterForm">
                                <option hidden="">Сортировка</option>
                                <option value="price">По цене</option>
                                <option value="name">По названию</option>
                            </select>
                        </div>
                        <div class="shop__sorting-item custom-form__select-wrapper">
                            <select class="custom-form__select" name="order" form="filterForm">
                                <option hidden="">Порядок</option>
                                <option value="asc">По возрастанию</option>
                                <option value="desc">По убыванию</option>
                            </select>
                        </div>
                        <p class="shop__sorting-res">Найдено <span class="res-sort">{{ $products->total() }}</span> моделей</p>
                    </section>

                    <!-- Динамический список товаров -->
                    <section class="shop__list">
                        @if($products->count())
                            @foreach ($products as $product)
                                <article class="shop__item product" tabindex="0">
                                    <div class="product__image">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                    </div>
                                    <p class="product__name">{{ $product->name }}</p>
                                    <span class="product__price">{{ $product->price }} грн.</span>
                                </article>
                            @endforeach
                        @else
                            <p>Товары не найдены.</p>
                        @endif
                    </section>

                    <!-- Пагинация -->
                    <ul class="shop__paginator paginator">
                        {{ $products->withQueryString()->links('pagination::bootstrap-4') }}

                    </ul>
                </div>
            </section>

            <!-- Форма оформления заказа -->
            <section class="shop-page__order" hidden="">
                <div class="shop-page__wrapper">
                    <h2 class="h h--1">Оформление заказа</h2>
                    <!-- Сообщение об ошибке -->
                    @if(session('status'))
                        <div class="alert alert-danger">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('order.store') }}" method="POST" class="custom-form js-order">
                        @csrf


                        <fieldset class="custom-form__group">
                            <legend class="custom-form__title">Укажите свои личные данные</legend>
                            <p class="custom-form__info">
                                <span class="req">*</span> поля обязательные для заполнения
                            </p>
                            <div class="custom-form__column">
                                <label class="custom-form__input-wrapper" for="surname">
                                    <input id="surname" class="custom-form__input" type="text" name="surname" required>
                                    <p class="custom-form__input-label">Фамилия <span class="req">*</span></p>
                                </label>
                                <label class="custom-form__input-wrapper" for="name">
                                    <input id="name" class="custom-form__input" type="text" name="name" required>
                                    <p class="custom-form__input-label">Имя <span class="req">*</span></p>
                                </label>
                                <label class="custom-form__input-wrapper" for="thirdName">
                                    <input id="thirdName" class="custom-form__input" type="text" name="thirdName">
                                    <p class="custom-form__input-label">Отчество</p>
                                </label>
                                <label class="custom-form__input-wrapper" for="phone">
                                    <input id="phone" class="custom-form__input" type="tel" name="phone" required>
                                    <p class="custom-form__input-label">Телефон <span class="req">*</span></p>
                                </label>
                                <label class="custom-form__input-wrapper" for="email">
                                    <input id="email" class="custom-form__input" type="email" name="email" required>
                                    <p class="custom-form__input-label">Почта <span class="req">*</span></p>
                                </label>
                            </div>
                        </fieldset>

                        <fieldset class="custom-form__group js-radio">
                            <legend class="custom-form__title custom-form__title--radio">Способ доставки</legend>
                            <input id="dev-no" class="custom-form__radio" type="radio" name="delivery_method" value="pickup" checked>
                            <label for="dev-no" class="custom-form__radio-label">Самовывоз</label>
                            <input id="dev-yes" class="custom-form__radio" type="radio" name="delivery_method" value="courier">
                            <label for="dev-yes" class="custom-form__radio-label">Курьерская доставка</label>
                        </fieldset>

                        <div class="shop-page__delivery shop-page__delivery--yes" hidden>
                            <fieldset class="custom-form__group">
                                <legend class="custom-form__title">Адрес</legend>
                                <p class="custom-form__info">
                                    <span class="req">*</span> поля обязательные для заполнения
                                </p>
                                <div class="custom-form__row">
                                    <label class="custom-form__input-wrapper" for="city">
                                        <input id="city" class="custom-form__input" type="text" name="city">
                                        <p class="custom-form__input-label">Город <span class="req">*</span></p>
                                    </label>
                                    <label class="custom-form__input-wrapper" for="street">
                                        <input id="street" class="custom-form__input" type="text" name="street">
                                        <p class="custom-form__input-label">Улица <span class="req">*</span></p>
                                    </label>
                                    <label class="custom-form__input-wrapper" for="home">
                                        <input id="home" class="custom-form__input custom-form__input--small" type="text" name="home">
                                        <p class="custom-form__input-label">Дом <span class="req">*</span></p>
                                    </label>
                                    <label class="custom-form__input-wrapper" for="apartment">
                                        <input id="apartment" class="custom-form__input custom-form__input--small" type="text" name="apartment">
                                        <p class="custom-form__input-label">Квартира</p>
                                    </label>
                                </div>
                            </fieldset>
                        </div>

                        <fieldset class="custom-form__group shop-page__pay">
                            <legend class="custom-form__title custom-form__title--radio">Способ оплаты</legend>
                            <input id="cash" class="custom-form__radio" type="radio" name="payment_method" value="cash">
                            <label for="cash" class="custom-form__radio-label">Наличные</label>
                            <input id="card" class="custom-form__radio" type="radio" name="payment_method" value="card" checked>
                            <label for="card" class="custom-form__radio-label">Банковской картой</label>
                        </fieldset>

                        <fieldset class="custom-form__group shop-page__comment">
                            <legend class="custom-form__title custom-form__title--comment">Комментарии к заказу</legend>
                            <textarea class="custom-form__textarea" name="comment"></textarea>
                        </fieldset>

                        <button class="button" type="submit">Отправить заказ</button>
                    </form>
                </div>
            </section>

            <script>

                document.querySelector('.js-order').addEventListener('submit', function(event) {
                    const requiredFields = ['surname', 'name', 'phone', 'email'];
                    let valid = true;

                    requiredFields.forEach(field => {
                        const input = document.querySelector(`[name="${field}"]`);
                        if (!input.value.trim()) {
                            valid = false;
                            alert(`Поле ${field} обязательно для заполнения.`);
                        }
                    });

                    if (!valid) {
                        event.preventDefault();
                    }
                });

            </script>



            <section class="shop-page__popup-end" hidden="">
                <div class="shop-page__wrapper shop-page__wrapper--popup-end">
                    <h2 class="h h--1 h--icon shop-page__end-title">Спасибо за заказ!</h2>
                    <p class="shop-page__end-message">Ваш заказ успешно оформлен, с вами свяжутся в ближайшее время</p>
                    <button class="button">Продолжить покупки</button>
                </div>
            </section>
        </main>
    </section>
@endsection
