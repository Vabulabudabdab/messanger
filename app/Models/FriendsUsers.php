<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FriendsUsers extends Model
{

    protected $table = 'new_friends';

    protected $fillable = ['from_user', 'to_user'];

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'to_user');
    }

    public function user_from() {
        return $this->hasMany(User::class, 'id', 'from_user');
    }

}
