<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {

    Route::get('/{user}', [\App\Http\Controllers\HomeController::class, 'index'])->name('index.home');

    Route::post('/image/edit/{user}', [\App\Http\Controllers\HomeController::class, 'edit_image'])->name('index.profile.image.edit');
    Route::post('/create/post', [\App\Http\Controllers\HomeController::class, 'create_post'])->name('index.profile.create.post');
    Route::post('/post/like/{post}', [\App\Http\Controllers\HomeController::class, 'like_post'])->name('index.profile.post.like');
});
