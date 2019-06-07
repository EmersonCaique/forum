<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
    use  RefreshDatabase;

    /** @test */
    public function an_auth_user_may_participate_in_forum_threads()
    {
        $this->signIn($user = create('App\User'));

        $thread = create('App\Thread');
        $reply = raw('App\Reply');

        $this->post("thread/{$thread->channel->slug}/{$thread->id}/replies", $reply);

        $this->assertDatabaseHas('replies', [
            'body' => $reply['body'],
            'user_id' => $user->id,
        ]);

        $this
            ->get("thread/{$thread->channel->slug}/{$thread->id}")
            ->assertSee($reply['body']);
    }

    /** @test */
    public function a_reply_require_a_body()
    {
        $thread = create('App\Thread');
        $reply = raw('App\Reply', ['body' => null]);
        $this
            ->post("thread/{$thread->channel->slug}/{$thread->id}/replies", $reply)
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function unauthorized_users_cannot_delete_replies()
    {
        $reply = create('App\Reply');

        $this
            ->delete("reply/{$reply->id}")
            ->assertStatus(403);

        $this->signIn()
            ->delete("reply/{$reply->id}")
            ->assertStatus(403);
    }

    /** @test */
    public function authorized_users_can_delete_replies()
    {
        $reply = create('App\Reply');

        $this->signIn($reply->owner)
                ->delete("reply/{$reply->id}")
                ->assertStatus(302);
    }
}
