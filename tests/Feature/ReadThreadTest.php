<?php

namespace Tests\Feature;

use Tests\TestCase;

class ReadThreadTest extends TestCase
{
    /** @test */
    public function a_user_can_view_all_threads()
    {
        $thread = create('App\Thread');

        $response = $this->get('thread');

        $response->assertSee($thread->title);
        $response->assertSee($thread->body);
    }

    /** @test */
    public function a_user_can_view_a_single_thread()
    {
        $thread = create('App\Thread');

        $response = $this->get('thread/'.$thread->id);
        $response->assertSee($thread->title);
        $response->assertSee($thread->body);
    }

    /** @test */
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $reply = create('App\Reply', ['thread_id' => $thread = create('App\Thread')]);

        $response = $this->get('thread/'.$thread->id);
        $response->assertSee($reply->body);
    }
}
