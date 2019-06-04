<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_user_has_a_profile()
    {
        $user = create('App\User');
        $this->get("profile/{$user->name}")
            ->assertSee($user->name);
    }

    /** @test */
    public function profile_display_all_threads_created_by_the_associated_user()
    {
        $user = create('App\User');

        $user->threads()->save($thread = make('App\Thread'));
        $this->get("profile/{$user->name}")
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
