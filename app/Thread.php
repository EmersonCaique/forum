<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    public function replies()
    {
        return $this->hasMany('App\Reply');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function addReply(Reply $reply)
    {
        $this->replies()->save($reply);
    }
}
