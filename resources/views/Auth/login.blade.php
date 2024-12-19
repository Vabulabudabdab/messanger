@extends('layout.auth')

@section('content')

    <form action="{{route('auth.login.post')}}" method="post" class="auth_form_login">
        @csrf
        <div class="auth_answer">
            Вход
        </div>

        <div class="auth_error">
            {{session('success_change_password')}}
        </div>

        <div class="form-group">
            <input type="email" class="auth_input" placeholder="Email" name="email">
            <div class="answer">Введите email, указанный при регистрации</div>
        </div>

        <div class="form-group">
            <input type="password" class="auth_input" placeholder="Password" name="password">
            <div class="answer">Забыли пароль? <a href="{{route('auth.change-password')}}" class="base_href">Восстановить</a></div>
        </div>

        <br>
        <div class="form-group">
            <button type="submit" class="auth-btn">Войти</button>
        </div>

        <div class="form-group">
            <div class="exists_account">
                Нет аккаунта? <a href="{{route('auth.register.get')}}" class="base_href">Зарегистрироваться</a>
            </div>
        </div>

    </form>

@endsection
