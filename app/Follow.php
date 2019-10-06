<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = [
        'user_id', 'follow_user_id'
    ];
    
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }
    
}
