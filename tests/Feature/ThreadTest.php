<?php

namespace Tests\Feature;

use Tests\TestCase;

class ThreadTest extends TestCase
{
    /** @test */
    public function guest_may_not_create_thread()
    {
        $response = $this->post('thread', raw('App\Thread'));
        $response->assertRedirect('login');
    }

    /** @test */
    public function an_authenticated_user_can_create_new_forum_threads()
    {
        $this
            ->signIn()
            ->post('thread', $thread = raw('App\Thread'));

        $this->assertDatabaseHas('threads', [
            'title' => $thread['title'],
            'body' => $thread['body'],
        ]);
    }
}
