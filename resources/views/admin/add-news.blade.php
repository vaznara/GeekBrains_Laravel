@extends('layouts.main')

@section('title', 'Добавить новость')

@section('navigation')
    @include('admin.navigation')
@endsection

@section('content')
    <div class="container">
        <div class="form-wrap">
            <form class="login-form" method="POST" action="{{ route('admin.news.add') }}">
                @csrf
                <div class="input-wrap">
                    <p>Заголовок:</p>
                    <input type="text" name="news-header" value="{{ old('news-header') }}">
                </div>
                <div class="input-wrap">
                    <p>Категория:</p>
                    <select name="category-selector">
                        @foreach($categories as $item)
                            <option @if ($item['uri_name'] == old('category-selector')) selected @endif value="{{ $item['uri_name'] }}">{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-wrap">
                    <p>Тело новости:</p>
                    <textarea name="news-body" rows="10">{{ old('news-body') }}</textarea>
                </div>
                <div class="btn-wrap">
                    <button type="submit" class="btn">Добавить новость</button>
                </div>
            </form>
        </div>
    </div>
@endsection
