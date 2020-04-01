<nav class="main__menu">
    <ul class="main__menu-list">
        <li class="main__menu-item"><a href="<?=Route('Home')?>">Главная</a></li>
        <li class="main__menu-item {{ (strpos(Route::currentRouteName(), 'About') === 0) ? 'active' : '' }}"><a href="<?=Route('About')?>">О проекте</a></li>
        <li class="main__menu-item {{ (strpos(Route::currentRouteName(), 'news.News') === 0) ? 'active' : '' }}"><a href="<?=Route('news.News')?>">Новости</a></li>
        <li class="main__menu-item {{ (strpos(Route::currentRouteName(), 'admin.Admin') === 0) ? 'active' : '' }}"><a href="<?=Route('admin.Admin')?>">Админка</a></li>
        <li class="main__menu-item {{ (strpos(Route::currentRouteName(), 'Login') === 0) ? 'active' : '' }}"><a href="<?=Route('Login')?>">Войти</a></li>
    </ul>
</nav>
