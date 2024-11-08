<!-- resources/views/partials/footer.blade.php -->
<footer class="page-footer">
    <div class="container">
        <a class="page-footer__logo" href="#">
            <img src="{{ asset('assets/img/logo--footer.svg') }}" alt="Fashion">
        </a>
        <nav class="page-footer__menu">
            <ul class="main-menu main-menu--footer">
                <li><a class="main-menu__item" href="{{ route('home') }}">Главная</a></li>
                <li><a class="main-menu__item" href="#">Новинки</a></li>
                <li><a class="main-menu__item" href="{{ route('home') }}">Sale</a></li>
                <li><a class="main-menu__item" href="#">Доставка</a></li>
            </ul>
        </nav>
        <address class="page-footer__copyright">© Все права защищены</address>
    </div>
</footer>

