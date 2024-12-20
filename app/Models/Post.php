<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $withCount = ['likedUsers'];
    protected $fillable = ['post_name', 'user_id', 'image', 'text'];

    public function relatedUsers() {
        return $this->belongsToMany(Post::class, 'users_posts', 'post_id', 'user_id');
    }

    public function likedUsers() {
        return $this->belongsToMany(User::class, 'posts_likeds', 'post_id', 'user_id');
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
