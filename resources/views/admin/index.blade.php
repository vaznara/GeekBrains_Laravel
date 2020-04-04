@extends('layouts.main')

@section('title', 'Главная страница')

@section('navigation')
    @include('admin.navigation')
@endsection

@section('content')
    <p class="message">Добро пожаловать в ваш личный кабинет Admin.</p>
@endsection
