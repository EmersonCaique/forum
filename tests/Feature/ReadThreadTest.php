<?php

namespace Tests\Feature;

use Tests\TestCase;

class ReadThreadTest extends TestCase
{
    /** @test */
    public function a_user_can_view_all_threads()
    {
        $this->withoutExceptionHandling();
        $thread = create('App\Thread');
        $response = $this->get(route('thread'));

        $response->assertSee($thread->title);
        $response->assertSee($thread->body);
    }

    /** @test */
    public function a_user_can_view_a_single_thread()
    {
        $thread = create('App\Thread');

        $response = $this->get("thread/{$thread->channel->slug}/{$thread->id}");
        $response->assertSee($thread->title);
        $response->assertSee($thread->body);
    }

    /** @test */
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $reply = create('App\Reply', ['thread_id' => $thread = create('App\Thread')]);
        $response = $this->get("thread/{$thread->channel->slug}/{$thread->id}/replies");

        $this->withoutExceptionHandling();
        $response->assertSee($reply->body);
    }

    /** @test */
    public function a_user_can_filter_threads_according_to_a_channel()
    {
        $threadInChannel = create('App\Thread');

        $this
            ->get("thread/{$threadInChannel->channel->slug}")
            ->assertSee($threadInChannel->title);
    }

    /** @test */
    public function a_user_can_filter_threads_by_any_username()
    {
        $this->signIn(create('App\User', ['name' => 'JohnDoe']));
        $threadByJohn = create('App\Thread', ['user_id' => auth()->id()]);

        $this
            ->get('thread?by=JohnDoe')
            ->assertSee($threadByJohn->title);
    }
}
