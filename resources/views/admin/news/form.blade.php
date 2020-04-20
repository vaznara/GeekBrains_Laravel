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

                <div class="input-wrap @error('title') is-invalid @enderror">

                    <label for="title">Заголовок:</label>
                    @isset($news)
                        <input type="text" name="title" id="title"
                               value="@if(old('title') === null) {{ $news->title }} @else {{ old('title') }} @endif"
                               class="@error('title') is-invalid @enderror">
                    @endisset

                    @empty($news)
                        <input type="text" name="title" id="title"
                               value="{{ old('title') }}"
                               class="@error('title') is-invalid @enderror">
                    @endempty

                    @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>

                <div class="input-wrap @error('category_id') is-invalid @enderror">
                    <label for="category_id">Категория:</label>

                    <select name="category_id" id="category_id" class="@error('category_id') is-invalid @enderror">

                        @isset($news)

                            @if(old('category_id') === null)
                                @foreach($categories as $item)
                                    <option @if ($item->id == $news->category_id) selected
                                            @endif value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach

                            @else

                                @foreach($categories as $item)
                                    <option @if ($item->id == old('category_id')) selected
                                            @endif value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach

                            @endif

                        @endisset

                        @empty($news)
                            @foreach($categories as $item)
                                <option @if ($item->id == old('category_id')) selected
                                        @endif value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        @endempty

                    </select>

                    @error('category_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>

                <div class="input-wrap @error('body') is-invalid @enderror">
                    <label for="body">Тело новости:</label>

                    @isset($news)
                        <textarea name="body" id="body" rows="5"
                                  class="@error('body') is-invalid @enderror">@if(old('body') === null) {{ $news->body }} @else {{ old('body') }} @endif</textarea>
                    @endisset

                    @empty($news)
                        <textarea name="body" id="body" rows="5"
                                  class="@error('body') is-invalid @enderror">{{ old('body') }}</textarea>
                    @endempty

                    @error('body')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>
                <div class="input-wrap @error('image') is-invalid @enderror">

                    <label for="file">Выбрать картинку:</label>
                    <input type="file" name="image" value="{{ old('image') }}"
                           class="@error('image') is-invalid @enderror"/>

                    @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>

                <div class="btn-wrap">
                    <button type="submit" class="btn">Сохранить</button>
                </div>

            </form>
        </div>
    </div>
@endsection
