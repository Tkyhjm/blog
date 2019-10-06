<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_image', 'message', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
//    各テーブルの紐づけ処理
    public function posts()
    {
        return $this->hasMany(\App\Post::class, 'user_id', 'id');
    }
    
    public function comments() {
        return $this->hasMany(\App\Post::class, 'user_id', 'id');
    }
    
    public function goods()
    {
        return $this->hasMany(\App\Good::class, 'user_id', 'id');
    }
    
    public function follows()
    {
        return $this->hasMany(\App\Follow::class, 'user_id', 'id');
    }
}
