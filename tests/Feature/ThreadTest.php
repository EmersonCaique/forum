<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_all_threads()
    {
        $thread = factory('App\Thread')->create();

        $response = $this->get('thread');

        $response->assertSee($thread->title);
        $response->assertSee($thread->body);
    }

    /** @test */
    public function a_user_can_a_single_thread()
    {
        $thread = factory('App\Thread')->create();

        $response = $this->get('thread/'.$thread->id);
        $response->assertSee($thread->title);
        $response->assertSee($thread->body);
    }
}
