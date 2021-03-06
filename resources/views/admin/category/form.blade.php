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

                <div class="input-wrap @error('name') is-invalid @enderror">
                    <label for="name">Название:</label>

                    @isset($category)
                        <input type="text" name="name" id="name"
                               value="@if(old('name') === null){{ $category->name }}@else{{ old('name') }}@endif"
                               class="@error('name') is-invalid @enderror">
                    @endisset

                    @empty($category)
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="@error('name') is-invalid @enderror">
                    @endempty

                    @error('name')
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
