<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $fillable = [
        'id',
        'full_name',
        'profile_picture',
        'username',
        'username',
        'created_at',
        'updated_at'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function image()
    {
        return $this->hasMany(Image::class);
    }
}