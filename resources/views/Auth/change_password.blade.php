@extends('layout.auth')

@section('content')

    <form action="{{route('auth.change-password.post')}}" method="post" class="auth_form_login">
        @csrf
        <div class="auth_answer">
            Восстановление пароля
        </div>

        <div class="form-group">
            <input type="email" class="auth_input" placeholder="Email" name="email" style="margin-top: 70px">
            <div class="answer">На почту придёт ссылка с инструкцией по восстановлению</div>
        </div>

        <br>
        <div class="form-group">
            <button type="submit" class="auth-btn">Восстановить пароль</button>
        </div>

    </form>

@endsection
