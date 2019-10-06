<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'title', 'content', 'image', 'type'
    ];
    
//    各テーブルの紐づけ処理
    public function user() {
        return $this->belongsTo(\App\User::class, 'user_id');
    }
    
    public function comments()
    {
        return $this->hasMany(\App\Comment::class, 'post_id', 'id');
    }

    public function goods()
    {
        return $this->hasMany(\App\Good::class, 'post_id', 'id');
    }
    

}
