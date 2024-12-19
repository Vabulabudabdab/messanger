<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\RestorePasswordRequest;
use App\Models\RestorePassword;
use Illuminate\Support\Facades\Log;

class AuthController extends BaseController {

    public function register() {
        return view('auth.register');
    }

    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register_post(RegisterRequest $request) {

        $data = $request->validated();

        $this->authService->register_post($data);

        return redirect()->route('welcome');
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login_post(LoginRequest $request) {

        $data = $request->validated();

        $result = $this->authService->login_post($data);

        if($result == null) {
            return  redirect()->back()->with('error_login', 'Неверный логин или пароль!');
        } else {
            return redirect()->route('welcome');
        }
    }

    public function change_password() {
        return view('auth.change_password');
    }

    public function change_password_post(ChangePasswordRequest $request) {

        $data = $request->validated();

        $this->authService->restore_password($data);

        return redirect()->route('auth.login.get');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|void
     */
    public function change_password_restore() {

        $user_id = request()->segment(4);
        $token = request()->segment(3);

        $check_user = RestorePassword::all()->where('user_id', $user_id)->sortByDesc('uuid')->first();
        $check_token = RestorePassword::all()->where('uuid', $token)->sortByDesc('uuid')->first();

        if(!empty($check_token->uuid) && !empty($check_user->user_id)) {

            $user_id = $check_user;
            $token = $check_token;

            return view('auth.password_restore', compact('token', 'user_id'));

        } else {
            abort(404);
        }

    }

    public function change_password_restore_post($token, $user_id, RestorePasswordRequest $request) {
        $data = $request->validated();

        $this->authService->change_password_token_request($token, $user_id, $data);

        return redirect()->route('auth.login.get')->with('success_change_password', 'Вы успешно сменили пароль');
    }

    public function login() {
        return view('auth.login');
    }

}
