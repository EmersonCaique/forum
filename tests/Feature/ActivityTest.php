<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Activity;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_records_activity_when_a_thread_is_created()
    {
        $this->signIn();
        $thread = create('App\Thread');

        $this->assertDatabaseHas('activities', [
            'type' => 'created_thread',
            'user_id' => auth()->id(),
            'subject_id' => $thread->id,
            'subject_type' => 'App\Thread',
        ]);

        $activity = Activity::first();
        $this->assertEquals($activity->subject->id, $thread->id);
    }

    /** @test */
    public function it_records_activity_when_a_reply_is_created()
    {
        $this->signIn();
        $reply = create('App\Reply');

        $this->assertDatabaseHas('activities', [
             'type' => 'created_reply',
             'user_id' => auth()->id(),
             'subject_id' => $reply->id,
             'subject_type' => 'App\Reply',
         ]);

        $this->assertEquals(2, Activity::count());
    }

    /** @test */
    public function it_fetches_a_feed_for_any_users()
    {
        $this->signIn();

        create('App\Thread', ['user_id' => auth()->id()], 2);
        auth()->user()->activities()->first()->update(['created_at' => now()->subWeek()]);
        $feed = Activity::feed(auth()->user());

        $this->assertTrue($feed->keys()->contains(now()->format('Y-m-d')));
        $this->assertTrue($feed->keys()->contains(now()->subWeek()->format('Y-m-d')));
    }
}
