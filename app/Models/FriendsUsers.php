<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FriendsUsers extends Model
{

    protected $table = 'request_users';

    protected $fillable = ['status', 'user_id', 'from_id'];

    CONST DECLANE = 0;
    CONST ACCEPT = 1;
    CONST WAIT = 2;

    public function getStatusId() {
        return [
          self::DECLANE => "Отклонена",
          self::ACCEPT => "Принята",
          self::WAIT => "Ожидание"
        ];
    }

//    public function getStatusAttribute() {
//        return self::getStatusId()[$this->status];
//    }

}
