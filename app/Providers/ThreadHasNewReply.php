<?php

namespace App\Providers;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class ThreadHasNewReply
{
    use Dispatchable, SerializesModels;

    public $reply;
    public $thread;

    public function __construct($thread, $reply)
    {
        $this->thread = $thread;
        $this->reply = $reply;
    }
}
