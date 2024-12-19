<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(
    base_path('routes\auth\routes.php')
);

Route::get('/', function () {
    return \auth()->user();
})->name('welcome');

Auth::routes(['verify' => true]);
