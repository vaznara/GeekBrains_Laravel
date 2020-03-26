@extends('layouts.main')
@section('title', 'Новости')
@section('page-title')
    <h1>@yield('title')</h1>
@endsection
@section('content')
    <section class="news">
        @foreach ($news as $item)
            <div class="news__item">
                <h3>{{ $item['title'] }}</h3>
                <p>{{ Str::limit($item['body'], 80) }}</p>
                <a href="{{ route('news.SingleNews', $item['id']) }}" class="btn">Подробнее</a>
            </div>
        @endforeach
    </section>
@endsection
