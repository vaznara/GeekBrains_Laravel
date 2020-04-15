@extends('layouts.main')

@section('title', 'Добавить новость')

@section('navigation')
    @include('navigation')
@endsection

@section('content')
    <div class="container">
        <div class="form-wrap">
            <form class="main-form" method="POST"
                  action="@isset($news) {{ route('admin.news.update', $news) }} @endisset @empty($news) {{ route('admin.news.store') }} @endempty"
                  enctype="multipart/form-data">
                @csrf
                @isset($news)
                    @method('PATCH')
                @endisset
                <div class="input-wrap">
                    <label for="title">Заголовок:</label>
                    @isset($news)
                        <input type="text" name="title" id="title" value="{{ $news->title }}">
                    @endisset
                    @empty($news)
                        <input type="text" name="title" id="title" value="{{ old('title') }}">
                    @endempty
                </div>
                <div class="input-wrap">
                    <label for="category_id">Категория:</label>
                    <select name="category_id" id="category_id">
                        @isset($news)
                            @foreach($categories as $item)
                                <option @if ($item->id == $news->category_id) selected
                                        @endif value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        @endisset
                        @empty($news)
                            @foreach($categories as $item)
                                <option @if ($item->id == old('category_id')) selected
                                        @endif value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        @endempty
                    </select>
                </div>
                <div class="input-wrap">
                    <label for="body">Тело новости:</label>
                    @isset($news)
                        <textarea name="body" id="body" rows="5">{{ $news->body }}</textarea>
                    @endisset
                    @empty($news)
                        <textarea name="body" id="body" rows="5">{{ old('body') }}</textarea>
                    @endempty
                </div>
                <div class="input-wrap">
                    <label for="file">Выбрать картинку:</label>
                    <input type="file" name="image"/>
                </div>

                <div class="btn-wrap">
                    <button type="submit" class="btn">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
