@extends('layouts.main')
@section('title', 'Добавить новость')
@section('navigation')
    @include('admin.navigation')
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
                    <p>Категория:</p>
                    <select name="category-selector">
                        <option value="politics">Политика</option>
                        <option value="sport">Спорт</option>
                        <option value="economy">Экономика</option>
                    </select>
                </div>
                <div class="input-wrap">
                    <p>Тело новости:</p>
                    <textarea name="Text1" rows="10"></textarea>
                </div>
                <div class="btn-wrap">
                    <button class="form-btn">Добавить новость</button>
                </div>
            </form>
        </div>
    </div>
@endsection
