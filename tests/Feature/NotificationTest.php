<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class NotificationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_notification_is_prepared_when_a_subscriber_thread_recives_new_reply_that_is_not_by_the_current_user()
    {
        $this->signIn();

        $thread = create('App\Thread')->subscribe();
        $this->assertCount(0, auth()->user()->notifications);

        $thread->addReply(make('App\Reply', ['user_id' => auth()->id()]));

        $this->assertCount(0, auth()->user()->fresh()->notifications);

        $thread->addReply(make('App\Reply'));

        $this->assertCount(1, auth()->user()->fresh()->notifications);
    }

    /** @test */
    public function a_user_can_fecth_their_unred_notificaitions()
    {
        $this->signIn();

        $thread = create('App\Thread')->subscribe();
        $thread->addReply(make('App\Reply'));

        $user = auth()->user();

        $response = $this->getJson("profile/{$user->name}/notification/");

        $this->assertCount(1, $response->getData());
    }

    /** @test */
    public function a_user_can_mark_a_notification_as_read()
    {
        $this->signIn();

        $thread = create('App\Thread')->subscribe();
        $thread->addReply(make('App\Reply'));

        $user = auth()->user();

        $this->assertCount(1, $unreadNotifications = $user->unreadNotifications);

        $notificationId = $unreadNotifications->first()->id;

        $this->delete("profile/{$user->name}/notification/{$notificationId}");

        $this->assertCount(0, $user->fresh()->unreadNotifications);
    }
}
