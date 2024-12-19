@extends('layout.auth')

@section('content')

    <form action="{{route('auth.change-password.restore.post', [$token->uuid, $user_id->user_id])}}" method="post" class="auth_form_login">
        @csrf
        <div class="auth_answer">
            Восстановление пароля
        </div>

        <div class="form-group">
            <input type="password" class="auth_input" placeholder="Password" name="password" style="margin-top: 50px">
            <div class="answer">Придумайте новый пароль</div>
        </div>

        <div class="form-group">
            <input type="password" class="auth_input" placeholder="Password" name="password_confirmation">
            <div class="answer">Подтвердите пароль</div>
        </div>

        <br>
        <div class="form-group">
            <button type="submit" class="auth-btn">Сменить пароль</button>
        </div>

    </form>
@endsection
