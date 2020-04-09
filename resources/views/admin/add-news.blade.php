@extends('layouts.main')

@section('title', 'Добавить новость')

@section('navigation')
    @include('navigation')
@endsection

@section('content')
    <div class="container">
        <div class="form-wrap">
            <form class="login-form" method="POST" action="{{ route('admin.news.add') }}" enctype="multipart/form-data">
                @csrf
                <div class="input-wrap">
                    <p>Заголовок:</p>
                    <input type="text" name="news_title" value="{{ old('news_title') }}">
                </div>
                <div class="input-wrap">
                    <p>Категория:</p>
                    <select name="news_category">
                        @foreach($categories as $item)
                            <option @if ($item->uri_name == old('news_category')) selected @endif value="{{ $item->uri_name }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-wrap">
                    <p>Тело новости:</p>
                    <textarea name="news_body" rows="5">{{ old('news_body') }}</textarea>
                </div>
                <div class="input-wrap">
                    <label for="file">Выбрать картинку:</label>
                    <input type="file" name="news_image"/>

                </div>

                <div class="btn-wrap">
                    <button type="submit" class="btn">Добавить новость</button>
                </div>
            </form>
        </div>
    </div>
@endsection
