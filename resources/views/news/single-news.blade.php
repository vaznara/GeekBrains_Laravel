@extends('layouts.main')

@section('title', $singleNews->title)

@section('content')
    <div class="card mb-3">
        <div class="card-img-top" style="background: url({{ $singleNews->image ? $img_path . $singleNews->image : $img_path . 'default.jpg' }}) no-repeat 50% 50%; background-size: cover; height: 200px;"></div>
        <div class="card-body">
            <h5 class="card-title">{{ $singleNews->title }}</h5>
            <p class="card-text">{!! $singleNews->body !!}</p>
        </div>
    </div>
    <a href="{{ route('news.News') }}" class="btn">назад к новостям</a>
@endsection
