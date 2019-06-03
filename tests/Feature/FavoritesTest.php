<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FavoritesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_favorite_anything()
    {
        $reply = create('App\Reply', ['thread_id' => factory('App\Thread')->create()]);

        $this
            ->post('reply/1/favorites')
            ->assertStatus(302)
            ->assertRedirect('login');
    }

    /** @test */
    public function a_auth_user_can_favorite_any_reply()
    {
        $this->signIn();
        $reply = create('App\Reply', ['thread_id' => factory('App\Thread')->create()]);
        $this->post("reply/{$reply->id}/favorites");

        $this->assertCount(1, $reply->favorites);
    }

    /** @test */
    public function an_auth_user_may_only_favorite_a_reply_once()
    {
        $this->signIn();
        $reply = create('App\Reply', ['thread_id' => factory('App\Thread')->create()]);
        $this->post("reply/{$reply->id}/favorites");
        $this->post("reply/{$reply->id}/favorites");
        $this->post("reply/{$reply->id}/favorites");

        $this->assertCount(1, $reply->favorites);
    }
}
