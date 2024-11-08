<!-- resources/views/partials/filter.blade.php -->
<form method="GET" action="{{ route('catalog.index') }}">
    <div class="filter__wrapper">
        <b class="filter__title">Категории</b>
        <ul class="filter__list">
            <li>
                <a href="{{ route('catalog.index', array_merge(request()->all(), ['category' => 'Все'])) }}"
                   class="filter__list-item {{ request('category') == 'Все' ? 'active' : '' }}">

                </a>
            </li>
            @foreach ($categories as $category)
                <li>
                    <a href="{{ route('catalog.index', array_merge(request()->all(), ['category' => $category->name])) }}"
                       class="filter__list-item {{ request('category') == $category->name ? 'active' : '' }}">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="filter__wrapper">
        <b class="filter__title">Цена</b>
        <input type="text" name="min_price" value="{{ request('min_price') }}" placeholder="Мин цена">
        <input type="text" name="max_price" value="{{ request('max_price') }}" placeholder="Макс цена">
    </div>
    <label>
        <input type="checkbox" name="is_new" {{ request('is_new') ? 'checked' : '' }}> Новинка
    </label>
    <label>
        <input type="checkbox" name="is_sale" {{ request('is_sale') ? 'checked' : '' }}> Распродажа
    </label>
    <select name="sort_by">
        <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>По названию</option>
        <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>По цене</option>
    </select>
    <select name="order">
        <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>По возрастанию</option>
        <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>По убыванию</option>
    </select>
    <button type="submit">Применить</button>
</form>
