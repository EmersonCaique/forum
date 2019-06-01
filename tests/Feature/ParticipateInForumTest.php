<?php

namespace Tests\Feature;

use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    /** @test */
    public function an_auth_user_may_participate_in_forum_threads()
    {
        $this->signIn($user = create('App\User'));

        $thread = create('App\Thread');
        $reply = raw('App\Reply');
        $this->post("thread/$thread->id/replies", $reply);

        $this->assertDatabaseHas('replies', [
            'body' => $reply['body'],
            'user_id' => $user->id,
        ]);

        $this
            ->get("thread/{$thread->id}")
            ->assertSee($reply['body']);
    }
}
