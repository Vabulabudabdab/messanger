<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(
    base_path('routes\home\routes.php')
);

Route::prefix('/auth')->group(
    base_path('routes\auth\routes.php'),
);


Auth::routes(['verify' => true]);
