<!-- resources/views/layouts/app.blade.php -->
<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Fashion')</title>
    <meta name="description" content="Fashion - интернет-магазин">
    <meta name="keywords" content="Fashion, интернет-магазин, одежда, аксессуары">
    <meta name="theme-color" content="#393939">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Подключение CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Предзагрузка шрифтов и изображений -->
    <link rel="preload" href="{{ asset('assets/img/intro/coats-2018.jpg') }}" as="image">
    <link rel="preload" href="{{ asset('assets/fonts/opensans-400-normal.woff2') }}" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/fonts/roboto-400-normal.woff2') }}" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/fonts/roboto-700-normal.woff2') }}" as="font" type="font/woff2" crossorigin="anonymous">

    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">

    <!-- Подключение JS -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('assets/js/scripts.js') }}" defer></script>
</head>
<body>

<!-- Подключение хедера -->
@include('partials.header')

<!-- Основной контент -->
<main class="container">
    @yield('content')
</main>

<!-- Подключение футера -->
@include('partials.footer')

<!-- Блок для авторизованных пользователей -->
@if(Auth::check())
    <div class="admin-links">
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}">Админ-панель</a>
        @endif
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-link">Выйти</button>
        </form>
    </div>
@endif

</body>
</html>
