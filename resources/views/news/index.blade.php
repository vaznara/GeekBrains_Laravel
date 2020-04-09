@extends('layouts.main')

@section('title', 'Новости')

@section('content')
    <ul class="nav nav-pills news-nav">
        <li class="nav-item">
            <a class="nav-link {{ (strpos(Route::currentRouteName(), 'news.News') === 0) ? 'active' : '' }}"
               href="{{ route('news.News') }}">Все</a>
        </li>
        @foreach($categories as $category)
            <li class="nav-item">
                <a class="nav-link {{ (request()->path() == 'news/categories/' . $category->uri_name) ? 'active' : '' }}"
                   href="{{ route('news.Categories', $category->uri_name) }}">{{ $category->name }}</a>
            </li>
        @endforeach
    </ul>
    <div class="row">
        @foreach ($news as $item)
            <div class="card col-4 border-0">
                <div class="card-img-top"
                     style="background: url({{ $item->image ? $img_path . $item->image : $img_path . 'default.jpg' }}) no-repeat 50% 50%; background-size: cover; height: 200px;"></div>
                <div class="card-body">
                    <h5 class="card-title">{{ $item->title }} <a href="{{ route('news.Categories', $item->uri_name) }}"><span
                                class="badge badge-dark">{{ $item->name }}</span></a></h5>
                    <p class="card-text">{!! str_limit($item->body, 60) !!}</p>
                    <a href="{{ route('news.SingleNews', $item->id) }}" class="btn btn-primary">Подробнее</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
