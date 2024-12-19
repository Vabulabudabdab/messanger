@extends('layout.auth')

@section('content')

    <form action="{{route('auth.register.post')}}" method="post" class="auth_form">
        @csrf
        <div class="auth_answer">
            Регистрация
        </div>

        <div class="form-group">
            <input type="text" class="auth_input" placeholder="Name" name="name">
            <div class="answer">Придумайте имя для сайта!</div>
        </div>

        <div class="form-group">
            <input type="email" class="auth_input" placeholder="Email" name="email">
            <div class="answer">На email придёт уведомление!</div>
        </div>

        <div class="form-group">
            <input type="password" class="auth_input" placeholder="Password" name="password">
            <div class="answer">Придумайте сложный пароль!</div>
        </div>

        <div class="form-group">
            <input type="password" class="auth_input" placeholder="Confirm password" name="password_confirmation">
            <div class="answer">Подтвердите пароль!</div>
        </div>

        <br>
        <div class="form-group">
            <button type="submit" class="auth-btn">Зарегистрироваться</button>
        </div>

        <div class="form-group">
            <div class="exists_account">
                Уже есть аккаунт? <a href="{{route('auth.login.get')}}" class="base_href">Войти</a>
            </div>
        </div>

    </form>

@endsection
