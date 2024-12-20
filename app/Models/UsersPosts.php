<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersPosts extends Model
{
    protected $table = 'users_posts';

    protected $fillable = ['user_id', 'post_id'];

    public function posts() {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public function relatedUsers() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
