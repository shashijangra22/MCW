<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function discussion()
    {
    	return $this->belongsTo(Discussion::class);
    }
}
