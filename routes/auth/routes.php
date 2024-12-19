<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/auth'], function () {

    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('auth.register.get');
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('auth.login.get');
    Route::get('/change_password', [\App\Http\Controllers\AuthController::class, 'change_password'])->name('auth.change-password');
    Route::get('/password_restore/{token}/{user_id}', [\App\Http\Controllers\AuthController::class, 'change_password_restore'])->name('auth.change-password.restore');


    Route::post('/register/post', [\App\Http\Controllers\AuthController::class, 'register_post'])->name('auth.register.post');
    Route::post('/login/post', [\App\Http\Controllers\AuthController::class, 'login_post'])->name('auth.login.post');
    Route::post('/change_password_post', [\App\Http\Controllers\AuthController::class, 'change_password_post'])->name('auth.change-password.post');
    Route::post('/password_restore/post/{token}/{user_id}', [\App\Http\Controllers\AuthController::class, 'change_password_restore_post'])->name('auth.change-password.restore.post');
});
