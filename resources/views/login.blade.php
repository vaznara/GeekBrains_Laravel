@extends('layouts.main')
@section('title', 'Вход')
@section('page-title')
    @endsection
@section('content')
    <div class="container">
        <div class="form-wrap">
            <form class="login-form">
                <h1 class="form-title">Вход</h1>
                <div class="input-wrap">
                    <input class="login-input" type="text" name="username" placeholder="Имя пользователя">
                </div>
                <div class="input-wrap">
                    <input class="login-input" type="password" name="password" placeholder="Пароль">
                </div>
                <div class="btn-wrap">
                    <button class="form-btn">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection
