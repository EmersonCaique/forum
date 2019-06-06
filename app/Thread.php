<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\RecordActivity;

class Thread extends Model
{
    protected $guarded = [];

    use RecordActivity;

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('reply_count', function ($builder) {
            return $builder->withCount('replies');
        });
    }

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
