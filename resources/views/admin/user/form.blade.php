@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Обновить пользователя</div>

                    <div class="card-body">
                        <form method="POST"
                              action="@isset($user) {{ route('admin.user.update', $user) }} @endisset @empty($user) {{ route('admin.user.store') }} @endempty">
                            @csrf

                            @isset($user)
                                @method('PATCH')
                            @endisset

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Имя</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="@if(old('name') === null){{ $user->name }}@else{{ old('name') }}@endif"
                                           required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>

                                <div class="col-md-6">

                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="@if(old('email') === null){{ $user->email }}@else{{ old('email') }}@endif"
                                           required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="role_id" class="col-md-4 col-form-label text-md-right">Роль:</label>

                                <div class="col-md-6">
                                    <select name="role_id" id="role_id"
                                            class="form-control @error('role_id') is-invalid @enderror">
                                        @foreach($roles as $role)
                                            <option @if ($role->id == $user->role_id) selected
                                                    @endif value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br/><br/>
                            <div class="form-group row" style="text-align: center;">
                                <div class="col-md-12">
                                    <a href="" class="btn btn-secondary" id="password-btn">
                                        Сменить пароль
                                    </a>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Новый пароль</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           autocomplete="new-password" readonly>

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Подтвердите
                                    пароль</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" autocomplete="new-password" readonly>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Обновить
                                    </button>
                                    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                                        Отмена
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-scripts')
<script>
    let passwordChangeButton = document.querySelector('#password-btn');

    passwordChangeButton.addEventListener('click', function (e) {

        e.preventDefault();

        let passwordField = document.querySelector('#password');
        let passwordConfirmField = document.querySelector('#password-confirm');

        passwordField.removeAttribute('readonly');
        // passwordField.setAttribute('required', '');

        passwordConfirmField.removeAttribute('readonly');
        // passwordConfirmField.setAttribute('required', '');

        e.currentTarget.className = '';
        e.currentTarget.classList.add('btn', 'btn-primary');

    });

</script>
@endsection
