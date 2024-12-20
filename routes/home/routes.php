<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {

    Route::get('/{user}', [\App\Http\Controllers\HomeController::class, 'index'])->name('index.home');

    Route::post('/image/edit/{user}', [\App\Http\Controllers\HomeController::class, 'edit_image'])->name('index.profile.image.edit');

});
