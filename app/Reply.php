<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\RecordActivity;
use App\Traits\Favoritable;

class Reply extends Model
{
    use RecordActivity, Favoritable;

    protected $fillable = ['body'];
    protected $appends = ['favoritesCount', 'isFavorited'];

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
