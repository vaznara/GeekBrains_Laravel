@extends('layouts.main')
@section('title', 'Новости')
@section('content')
    <section class="news">
        <div class="news__cat-wrap">
            <ul class="news__cat">
                @foreach($categories as $item)
                    <li class="news__cat-item">
                        <a href="{{ route('news.News') }}/{{ $item['uri_name'] }}"
                           class="news__cat-link">{{ $item['name'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection
