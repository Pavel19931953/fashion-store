
<!-- resources/views/partials/header.blade.php -->
<header class="page-header">
    <a class="page-header__logo" href="#">
        <img src="{{ asset('assets/img/logo.svg') }}" alt="Fashion">
    </a>
    <nav class="page-header__menu">
        <ul class="main-menu main-menu--header">
            <li>
               <a href="{{ route('catalog.index') }}">Главная</a>
            </li>
            <li>
                <a class="main-menu__item" href="{{ route('catalog.novinki') }}">Новинки</a>
            </li>

            <li>
                <a class="main-menu__item" href="{{ route('catalog.rasprodazha') }}">Распродажа</a>
            </li>

            <li>
                <a class="main-menu__item" href="{{ route('catalog.delivery') }}">Доставка</a>
            </li>
        </ul>
    </nav>
</header>

