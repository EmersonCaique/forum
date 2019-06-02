<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Channel;

class ThreadTest extends TestCase
{
    /** @test */
    public function guest_may_not_create_thread()
    {
        $thread = raw('App\Thread');
        $channel = Channel::find($thread['channel_id']);

        $this
            ->post('thread', $thread)
            ->assertRedirect('login');
    }

    /** @test */
    public function an_authenticated_user_can_create_new_forum_threads()
    {
        $thread = raw('App\Thread');
        $this
            ->signIn()
            ->post('thread', $thread);

        $this->assertDatabaseHas('threads', [
            'title' => $thread['title'],
            'body' => $thread['body'],
        ]);
    }

    /** @test */
    public function a_thread_require_a_title()
    {
        $this->publishThread(['title' => null])
               ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_thread_require_a_body()
    {
        $this->publishThread(['body' => null])
               ->assertSessionHasErrors('body');
    }

    /** @test */
    public function a_thread_require_a_channel_id()
    {
        $this->publishThread(['channel_id' => null])
                 ->assertSessionHasErrors('channel_id');
    }

    /** @test */
    public function a_thread_require_a_valid_channel()
    {
        $this->publishThread(['channel_id' => null])
                  ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => 99999])
                  ->assertSessionHasErrors('channel_id', 'Channel must exists');
    }

    public function publishThread($overrides = [])
    {
        $this->signIn();

        $thread = raw('App\Thread', $overrides);

        return $this->post('thread', $thread);
    }
}
