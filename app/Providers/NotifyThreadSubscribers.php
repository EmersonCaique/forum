<?php

namespace App\Providers;

class NotifyThreadSubscribers
{
    /**
     * Handle the event.
     *
     * @param ThreadHasNewReply $event
     */
    public function handle(ThreadHasNewReply $event)
    {
        $event
            ->thread
            ->subscriptions
            ->where('user_id', '!=', $event->reply->user_id)
            ->each
            ->notify($event->reply);
    }
}
