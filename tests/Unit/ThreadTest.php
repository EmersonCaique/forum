<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class ThreadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_thread_has_a_owner()
    {
        $thread = factory('App\Thread')->create();

        $this->assertInstanceOf(User::class, $thread->owner);
    }
}
