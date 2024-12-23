<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function friends() {
        return $this->belongsToMany(Friends::class, 'friends_saved', 'to_user', 'from_user');
    }
    public function friend_exists() {
        return $this->hasMany(Friends::class, 'from_user','id');
    }
    public function friend() {
        return $this->hasOne(FriendsUsers::class, 'to_user', 'id');
    }
    public function getFriends() {
        return $this->hasMany(Friends::class, 'to_user','id');
    }

    public function likedPosts() {
        return $this->belongsToMany(Post::class, 'posts_likeds', 'user_id', 'post_id');
    }

}
