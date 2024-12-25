<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {

    Route::get('/{user}', [\App\Http\Controllers\HomeController::class, 'index'])->name('index.home');
    Route::get('/friends/requests', [\App\Http\Controllers\HomeController::class, 'friend_requests'])->name('index.friends.requests');

    Route::post('/auth/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logoff');

    Route::post('/image/edit/{user}', [\App\Http\Controllers\HomeController::class, 'edit_image'])->name('index.profile.image.edit');

    Route::post('/add/friend/{user}', [\App\Http\Controllers\HomeController::class, 'add_friend_request'])->name('index.add.friend');
    Route::post('/friends/add/friend/{user}', [\App\Http\Controllers\HomeController::class, 'add_friend_request_from_list'])->name('index.add.friend.request');

    Route::post('/delete/friend/{user}', [\App\Http\Controllers\HomeController::class, 'delete_friend_request'])->name('delete.friend.request');

    Route::post('/search/friend', [\App\Http\Controllers\HomeController::class, 'search_friends'])->name('index.profile.search.friend');

    Route::post('/create/post', [\App\Http\Controllers\HomeController::class, 'create_post'])->name('index.profile.create.post');

    Route::post('/post/like/{post}', [\App\Http\Controllers\HomeController::class, 'like_post'])->name('index.profile.post.like');
});
