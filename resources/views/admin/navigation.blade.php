@section('navigation')
    <nav class="main__menu">
        <ul class="main__menu-list">
            <li class="main__menu-item"><a href="<?=Route('Home')?>">Главная</a></li>
            <li class="main__menu-item {{ (strpos(Route::currentRouteName(), 'admin.addnews') === 0) ? 'active' : '' }}"><a href="<?=Route('admin.addnews')?>">Добавить новость</a></li>
        </ul>
    </nav>
@endsection
