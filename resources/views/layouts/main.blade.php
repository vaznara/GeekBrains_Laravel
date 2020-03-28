<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project | @yield('title')</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<div class="wrapper">
    @section('navigation')
        <nav class="main__menu">
            <ul class="main__menu-list">
                <li class="main__menu-item"><a href="<?=Route('Home')?>">Главная</a></li>
                <li class="main__menu-item"><a href="<?=Route('About')?>">О проекте</a></li>
                <li class="main__menu-item"><a href="<?=Route('news.News')?>">Новости</a></li>
                <li class="main__menu-item"><a href="<?=Route('admin.Admin')?>">Админка</a></li>
                <li class="main__menu-item"><a href="<?=Route('Login')?>">Войти</a></li>
            </ul>
        </nav>
    @show
    @section('page-title')

    @show
    <div class="container content-container">
        @yield('content')
    </div>
</div>
</body>
</html>
