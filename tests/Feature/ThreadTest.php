<?php

namespace Tests\Feature;

use Tests\TestCase;

class ThreadTest extends TestCase
{
    /** @test */
    public function guest_may_not_create_thread()
    {
        $thread = raw('App\Thread');

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

    /** @test */
    public function unauthorize_user_may_not_delete_threads()
    {
        $thread = create('App\Thread');

        $this->delete("thread/{$thread->channel->slug}/{$thread->id}")->assertRedirect('/login');

        $this->assertDatabaseHas('threads', [
            'id' => $thread->id,
            'body' => $thread->body,
            'title' => $thread->title,
        ]);

        $this->signIn();

        $this->delete("thread/{$thread->channel->slug}/{$thread->id}")->assertStatus(403);
    }

    /** @test */
    public function authorize_user_can_delete_thread()
    {
        $this->signIn();
        $thread = create('App\Thread', ['user_id' => auth()->id()]);
        $reply = create('App\Reply', ['thread_id' => $thread->id]);

        $this
            ->json('DELETE', "thread/{$thread->channel->slug}/{$thread->id}")
            ->assertStatus(204);

        $this->assertDatabaseMissing('threads', [
            'id' => $thread->id,
            'body' => $thread->body,
            'title' => $thread->title,
        ]);

        $this->assertDatabaseMissing('replies', [
            'id' => $reply->id,
        ]);

        $this->assertDatabaseMissing('activities', [
            'subject_id' => $thread->id,
            'subject_type' => class_basename($thread),
        ]);

        $this->assertDatabaseMissing('activities', [
            'subject_id' => $reply->id,
            'subject_type' => class_basename($reply),
        ]);
    }

    /** @test */
    public function a_thread_can_be_subscribed()
    {
        $thread = create('App\Thread');

        $this->signIn();

        $thread->subscribe();

        $this->assertEquals(1, $thread->subscriptions()->where('user_id', auth()->id())->count());
    }

    /** @test */
    public function a_thread_can_be_unsubscribed()
    {
        $thread = create('App\Thread');

        $thread->subscribe($userId = 1);

        $this->assertEquals(1, $thread->subscriptions()->where('user_id', $userId)->count());

        $thread->unsubscribe($userId = 1);

        $this->assertEquals(0, $thread->subscriptions->fresh()->where('user_id', $userId)->count());
    }

    /** @test */
    public function it_knows_if_the_authenticated_user_is_subscribed_to_it()
    {
        $thread = create('App\Thread');
        $this->signIn();
        $this->assertFalse($thread->isSubscribedTo);
        $thread->subscribe();
        $this->assertTrue($thread->isSubscribedTo);
    }

    public function publishThread($overrides = [])
    {
        $this->signIn();

        $thread = raw('App\Thread', $overrides);

        return $this->post('thread', $thread);
    }
}
