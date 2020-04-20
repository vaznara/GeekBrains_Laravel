@extends('layouts.main')

@section('title', 'Категории')

@section('navigation')
    @include('navigation')
@endsection

@section('content')
    <h3>Таблица категории</h3>
    <a href="{{ route('admin.category.create') }}" class="btn btn-primary">Добавить категорию</a>
    <table class="laravel_table">
        <tr>
            <th class="table_cell-header">ID</th>
            <th class="table_cell-header">Название категории</th>
            <th class="table_cell-header">Ссылка</th>
            <th class="table_cell-header" colspan="2">Действие</th>
        </tr>
        @foreach($categories as $category)
            <tr>
                <td class="table_cell" style="text-align:center;">{{ $category->id }}</td>
                <td class="table_cell">{{ $category->name }}</td>
                <td class="table_cell"><a target="_blank" href="{{ route('news.Categories', $category->uri_name) }}">{{ route('news.Categories', $category->uri_name) }}</a></td>
                <td class="table_cell" style="text-align:center;">
                    <a href="{{ route('admin.category.edit', $category) }}">
                        <img src="{{ asset('storage/edit.svg') }}" alt="edit" style="width: 25px;height: auto;">
                    </a>
                </td>
                <td class="table_cell" style="text-align:center;">
                    <button type="button" data-toggle="modal" name="delete-btn" data-target="#confirm"
                            data-route="{{ route('admin.category.destroy', $category) }}">
                        <img src="{{ asset('storage/delete.svg') }}" alt="delete" style="width: 25px;height: auto;">
                    </button>
                </td>
            </tr>
        @endforeach
    </table>
    @include('components.modal', ['modaltext' => 'Вы уверены, что хотите удалить данную категорию? <br /> также будет удалены все новосто данной категорий.'])
@endsection
@section('custom-scripts')
    <script>
        let formButton = document.querySelectorAll(".table_cell button");

        for (let i = 0; i < formButton.length; i++) {
            formButton[i].addEventListener('click', function (e) {
                e.preventDefault();
                let actionUri = e.currentTarget.dataset.route;
                let modalForm = document.querySelector("#modal-form");
                modalForm.action = actionUri;
            })
        }
    </script>
@endsection
