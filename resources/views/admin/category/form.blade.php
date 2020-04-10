@extends('layouts.main')

@section('title', 'Добавить категорию')

@section('navigation')
    @include('navigation')
@endsection

@section('content')
    <div class="container">
        <div class="form-wrap">
            <form class="main-form" method="POST"
                  action="@isset($category) {{ route('admin.category.update', $category) }} @endisset @empty($category) {{ route('admin.category.store') }} @endempty"
                  enctype="multipart/form-data">
                @csrf
                @isset($category)
                    @method('PATCH')
                @endisset
                <div class="input-wrap">
                    <label for="name">Название:</label>
                    @isset($category)
                        <input type="text" name="name" id="name" value="{{ $category->name }}">
                    @endisset
                    @empty($category)
                        <input type="text" name="name" id="name" value="{{ old('title') }}">
                    @endempty
                </div>
                <div class="input-wrap">
                    <label for="uri_name">Название для URL:</label>
                    @isset($category)
                        <input type="text" name="uri_name" id="uri_name" value="{{ $category->uri_name }}">
                    @endisset
                    @empty($category)
                        <input type="text" name="uri_name" id="uri_name" value="{{ old('uri_name') }}">
                    @endempty
                </div>
                <div class="btn-wrap">
                    <button type="submit" class="btn">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
