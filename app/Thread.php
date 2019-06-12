<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\RecordActivity;

class Thread extends Model
{
    protected $guarded = [];

    protected $appends = ['isSubscribedTo'];

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

    public function subscribe($userId = null)
    {
        $this->subscriptions()->create([
            'user_id' => $userId ?: auth()->id(),
        ]);

        return $this;
    }

    public function unsubscribe($userId = null)
    {
        $this->subscriptions()->where('user_id', $userId ?: auth()->id())->delete();
    }

    public function subscriptions()
    {
        return $this->hasMany(ThreadSubscription::class);
    }

    public function addReply($reply)
    {
        $reply = $this->replies()->save($reply);

        $this
            ->subscriptions
            ->filter(function ($subscription) use ($reply) {
                return $subscription->user_id != $reply->user_id;
            })->each->notify($reply);

        return $reply;
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function getIsSubscribedToAttribute()
    {
        return $this->subscriptions()
            ->where('user_id', auth()->id())
            ->exists();
    }
}
