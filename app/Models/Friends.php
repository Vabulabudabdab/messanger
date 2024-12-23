<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friends extends Model
{
    protected $table = 'friends_saved';

    protected $fillable = ['from_user', 'to_user'];

    public function user() {
        return $this->hasMany(User::class, 'id', 'from_user');
    }

}
