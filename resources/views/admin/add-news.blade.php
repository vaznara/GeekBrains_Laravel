@extends('layouts.main')
@section('title', 'Добавить новость')
@section('navigation')
    @include('admin.nav')
@endsection
@section('page-title')
    <h1>@yield('title')</h1>
@endsection
@section('content')
    <div class="container">
        <div class="form-wrap">
            <form class="login-form">
                <div class="input-wrap">
                    <p>Заголовок:</p>
                    <textarea name="Text1" rows="2"></textarea>
                </div>
                <div class="input-wrap">
                    <p>Тело новости:</p>
                    <textarea name="Text1" rows="15"></textarea>
                </div>
                <div class="btn-wrap">
                    <button class="form-btn">Добавить новость</button>
                </div>
            </form>
        </div>
    </div>
@endsection
