<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class SubscribeToThreadTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_user_can_subscribe_to_thread()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        $thread = create('App\Thread');

        $this->post($r = route('thread.subscription.store', [$thread->channel, $thread]));

        $this->assertCount(1, $thread->fresh()->subscriptions);
    }
}
