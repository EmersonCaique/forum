<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\RecordActivity;
use App\Traits\Favoritable;

class Reply extends Model
{
    use RecordActivity, Favoritable;

    protected $fillable = ['body'];
    protected $with = ['owner'];
    protected $appends = ['favoritesCount', 'isFavorited'];

    public static function boot()
    {
        parent::boot();

        static::created(function ($reply) {
            $reply->thread->increment('replies_count');
        });

        static::deleted(function ($reply) {
            $reply->thread->decrement('replies_count');
        });
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite()
    {
        if (!$this->favorites()->where($attributes = ['user_id' => auth()->id()])->exists()) {
            return $this->favorites()->create($attributes);
        }
    }
}
