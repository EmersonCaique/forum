<?php

namespace App\Traits;

use App\Activity;

trait RecordActivity
{
    public static function bootRecordActivity()
    {
        if (auth()->guest()) {
            return;
        }
        foreach (static::getEvents() as $event) {
            static::$event(function ($model) use ($event) {
                $model->activities()->create([
                    'user_id' => auth()->id(),
                    'type' => "{$event}_{$model->getType()}",
                ]);
            });
        }
    }

    public function activities()
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    public function getType()
    {
        return strtolower((new \ReflectionClass($this))->getShortName());
    }

    public static function getEvents()
    {
        return  ['created'];
    }
}
