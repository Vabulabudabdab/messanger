<?php

namespace App\Models;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RestorePassword extends Model implements ShouldQueue
{

    use Notifiable;

    protected $table = 'restore_passwords';

    protected $fillable = ['uuid','user_id', 'expired'];

}
