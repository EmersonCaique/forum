<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = ['title', 'body', 'channel_id'];

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

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
