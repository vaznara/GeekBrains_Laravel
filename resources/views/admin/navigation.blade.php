@section('navigation')
    <nav class="main__menu">
        <ul class="main__menu-list d-flex justify-content-around">
            <li class="main__menu-item"><a href="<?=Route('Home')?>">Главная</a></li>
            <li class="main__menu-item {{ (strpos(Route::currentRouteName(), 'admin.news.add') === 0) ? 'active' : '' }}"><a href="<?=Route('admin.news.add')?>">Добавить новость</a></li>
        </ul>
    </nav>
@endsection
