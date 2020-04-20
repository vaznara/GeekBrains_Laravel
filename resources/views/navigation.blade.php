<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <a class="navbar-brand" href="{{ route('Home') }}">Laravel</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ (strpos(Route::currentRouteName(), 'Home') === 0) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('Home') }}">Главная</a>
            </li>
            <li class="nav-item {{ (strpos(Route::currentRouteName(), 'About') === 0) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('About') }}">О Проекте</a>
            </li>
            <li class="nav-item {{ (strpos(Route::currentRouteName(), 'news.News') === 0) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('news.News') }}">Новости</a>
            </li>

            @role('admin')
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                   data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Админка
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('admin.news.create') }}">Добавить новость</a>
                    <a class="dropdown-item" href="{{ route('admin.parser') }}">Спарсить новости</a>
                    <a class="dropdown-item" href="{{ route('admin.category.index') }}">Редактор категорий</a>
                    <a class="dropdown-item" href="{{ route('admin.user.index') }}">Пользователи</a>
                </div>
            </li>
            @endrole
        </ul>

        @guest
            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Вход</a>
                </li>
            </ul>
        @else
            <ul class="navbar-nav my-2 my-lg-0">
{{--                <li></li>--}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        @isset(Auth::user()->social_avatar_uri)
                            <img style="width: 32px;height: auto" src="{{ Auth::user()->social_avatar_uri }}" alt="{{ Auth::user()->name }}">&nbsp;&nbsp;&nbsp;
                        @endisset
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('password.change') }}">
                            Сменить пароль
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Выход
                        </a>
                    </div>
                </li>
            </ul>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endguest
    </div>
</nav>
