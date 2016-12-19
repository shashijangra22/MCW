<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function threads()
    {
        return $this->hasMany(Thread::class);
    }
}
