@extends('layouts.main')

@section('title', 'Категории')

@section('navigation')
    @include('navigation')
@endsection

@section('content')
    <h3>Пользователи</h3>
    <table class="laravel_table">
        <tr>
            <th class="table_cell-header">ID</th>
            <th class="table_cell-header">ФИО</th>
            <th class="table_cell-header">Email</th>
            <th class="table_cell-header">Email подтвержден</th>
            <th class="table_cell-header">Роль</th>
            <th class="table_cell-header" colspan="2">Действие</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td class="table_cell" style="text-align:center;">{{ $user->id }}</td>
                <td class="table_cell">{{ $user->name }}</td>
                <td class="table_cell">{{ $user->email }}</td>
                <td class="table_cell">@if($user->email_verified_at === null)нет@elseда@endif</td>
                <td class="table_cell">{{ $user->role }}</td>
                <td class="table_cell" style="text-align:center;">
                    <a href="{{ route('admin.user.edit', $user) }}">
                        <img src="{{ asset('storage/edit.svg') }}" alt="edit" style="width: 20px; height: auto;">
                    </a>
                </td>
                <td class="table_cell" style="text-align:center;">
                    <button type="button" data-toggle="modal" name="delete-btn" data-target="#confirm"
                            data-route="{{ route('admin.user.destroy', $user) }}">
                        <img src="{{ asset('storage/delete.svg') }}" alt="delete" style="width: 20px; height: auto; ">
                    </button>
                </td>
            </tr>
        @endforeach
    </table>
    <div>{{ $users->links() }}</div>
    @include('components.modal', ['modaltext' => 'Вы уверены, что хотите удалить данного пользователя?'])
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
