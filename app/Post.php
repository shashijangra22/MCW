<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Post extends Model
{
    public function likes()
    {
    	return $this->hasMany(Like::class);
    }
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
