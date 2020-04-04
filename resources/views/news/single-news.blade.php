@extends('layouts.main')

@section('title', $singleNews['title'])

@section('content')
    <section class="news">
        <div class="full-news__item">
                <h3>{{ $singleNews['title'] }}</h3>
                <p>{{ $singleNews['body'] }}</p>
            </div>
    </section>
@endsection
