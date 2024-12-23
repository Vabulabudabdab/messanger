<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FriendsUsers extends Model
{

    protected $table = 'new_friends';

    protected $fillable = ['from_user', 'to_user'];

    public function friends()
    {
        return $this->hasMany(User::class, 'id', 'to_user');
    }

}
