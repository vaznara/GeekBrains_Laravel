@extends('layouts.main')
@section('title', 'Категории новостей')
@section('page-title')
    <h1>@yield('title')</h1>
@endsection
@section('content')
    <section class="news">
        <div class="news__cat-wrap">
            <ul class="news__cat">
                @foreach($categories as $item)
                    <li class="news__cat-item">
                        <a href="{{ route('news.Categories') }}/{{ $item['uri_name'] }}"
                           class="news__cat-link">{{ $item['name'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection
