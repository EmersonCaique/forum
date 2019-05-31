<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_auth_user_may_participate_in_forum_threads()
    {
        $this->be($user = factory('App\User')->create());
        $thread = factory('App\Thread')->create();
        $reply = factory('App\Reply')->raw();
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
