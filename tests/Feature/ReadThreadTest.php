<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadThreadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_all_threads()
    {
        $thread = factory('App\Thread')->create();

        $response = $this->get('thread');

        $response->assertSee($thread->title);
        $response->assertSee($thread->body);
    }

    /** @test */
    public function a_user_can_view_a_single_thread()
    {
        $thread = factory('App\Thread')->create();

        $response = $this->get('thread/'.$thread->id);
        $response->assertSee($thread->title);
        $response->assertSee($thread->body);
    }

    /** @test */
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $reply = factory('App\Reply')->create(['thread_id' => $thread = factory('App\Thread')->create()]);

        $response = $this->get('thread/'.$thread->id);
        $response->assertSee($reply->body);
    }
}
