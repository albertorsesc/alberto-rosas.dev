<?php

namespace Tests\Feature;

use App\Mail\ConfirmSubscription;
use App\Mail\SubscriptionWelcome;
use App\Models\Subscriber;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Notifications\NewSubscriberNotification;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class SubscribeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Rate limiting is a prod concern; disabling it keeps these deterministic.
        $this->withoutMiddleware(ThrottleRequests::class);
        // Slack off by default so no test accidentally reaches for the network;
        // the Slack path is exercised explicitly in its own test.
        config()->set('services.slack.notifications.bot_user_oauth_token', null);
        config()->set('services.slack.notifications.channel', null);
        // Never let the suite reach the real Resend audience, even when the
        // developer's .env holds a live key + audience id. Bind a disabled Audience.
        $this->app->singleton(\App\Services\Resend\Audience::class, fn () => new \App\Services\Resend\Audience(null, null));
    }

    public function test_subscribing_creates_a_pending_record_and_sends_confirmation(): void
    {
        Mail::fake();

        $this->postJson(route('newsletter.subscribe'), ['email' => 'new@example.com', 'source' => 'home'])
            ->assertOk()
            ->assertJson(['ok' => true]);

        $this->assertDatabaseHas('subscribers', [
            'email' => 'new@example.com',
            'status' => 'pending',
            'source' => 'home',
        ]);

        Mail::assertSent(ConfirmSubscription::class, fn ($mail) => $mail->hasTo('new@example.com'));
    }

    public function test_email_is_normalised_before_saving(): void
    {
        Mail::fake();

        $this->postJson(route('newsletter.subscribe'), ['email' => '  New.User@Example.COM ', 'source' => 'footer'])
            ->assertOk();

        $this->assertDatabaseHas('subscribers', ['email' => 'new.user@example.com', 'source' => 'footer']);
    }

    public function test_a_filled_honeypot_is_silently_dropped(): void
    {
        Mail::fake();

        $this->postJson(route('newsletter.subscribe'), [
            'email' => 'bot@example.com',
            'source' => 'home',
            'website' => 'http://spam.example',
        ])->assertOk()->assertJson(['ok' => true]);

        // Looks successful to the bot, but nothing was written or emailed.
        $this->assertDatabaseCount('subscribers', 0);
        Mail::assertNothingSent();
    }

    public function test_invalid_email_returns_422_for_json_and_writes_nothing(): void
    {
        Mail::fake();

        $this->postJson(route('newsletter.subscribe'), ['email' => 'not-an-email'])
            ->assertStatus(422)
            ->assertJsonValidationErrors('email');

        $this->assertDatabaseCount('subscribers', 0);
        Mail::assertNothingSent();
    }

    public function test_invalid_email_redirects_back_with_errors_for_a_plain_post(): void
    {
        $this->post(route('newsletter.subscribe'), ['email' => 'not-an-email', 'source' => 'home'])
            ->assertRedirect()
            ->assertSessionHasErrors('email');
    }

    public function test_resubmitting_a_confirmed_email_succeeds_without_a_duplicate(): void
    {
        Subscriber::create(['email' => 'already@example.com', 'status' => 'confirmed', 'confirmed_at' => now()]);

        Mail::fake();
        $this->postJson(route('newsletter.subscribe'), ['email' => 'already@example.com'])->assertOk();

        Mail::assertNothingSent();
        $this->assertDatabaseCount('subscribers', 1);
    }

    public function test_confirming_marks_confirmed_and_sends_the_welcome(): void
    {
        Mail::fake();
        $subscriber = Subscriber::create(['email' => 'p@example.com', 'status' => 'pending', 'source' => 'footer']);

        $this->get(route('newsletter.confirm', $subscriber->token))
            ->assertOk()
            ->assertSee('on the list');

        $this->assertDatabaseHas('subscribers', ['email' => 'p@example.com', 'status' => 'confirmed']);
        $this->assertNotNull($subscriber->fresh()->confirmed_at);
        Mail::assertSent(SubscriptionWelcome::class, fn ($mail) => $mail->hasTo('p@example.com'));
    }

    public function test_confirming_pings_slack_when_configured(): void
    {
        config()->set('services.slack.notifications.bot_user_oauth_token', 'test-token');
        config()->set('services.slack.notifications.channel', '#alerts');
        Mail::fake();
        Notification::fake();
        $subscriber = Subscriber::create(['email' => 's@example.com', 'status' => 'pending', 'source' => 'home']);

        $this->get(route('newsletter.confirm', $subscriber->token))->assertOk();

        Notification::assertSentOnDemand(NewSubscriberNotification::class);
    }

    public function test_confirming_does_not_ping_slack_when_unconfigured(): void
    {
        // setUp already nulls the Slack config.
        Mail::fake();
        Notification::fake();
        $subscriber = Subscriber::create(['email' => 's@example.com', 'status' => 'pending']);

        $this->get(route('newsletter.confirm', $subscriber->token))->assertOk();

        Notification::assertNothingSent();
    }

    public function test_confirming_does_not_touch_the_network_when_resend_is_unconfigured(): void
    {
        Http::fake();
        Mail::fake();
        $subscriber = Subscriber::create(['email' => 'p@example.com', 'status' => 'pending']);

        $this->get(route('newsletter.confirm', $subscriber->token))->assertOk();

        Http::assertNothingSent();
        $this->assertNull($subscriber->fresh()->synced_at);
    }

    public function test_confirming_twice_does_not_resend_the_welcome(): void
    {
        $subscriber = Subscriber::create(['email' => 'p@example.com', 'status' => 'confirmed', 'confirmed_at' => now()]);

        Mail::fake();
        $this->get(route('newsletter.confirm', $subscriber->token))->assertOk();

        Mail::assertNothingSent();
    }

    public function test_unsubscribing_marks_the_subscriber_unsubscribed(): void
    {
        $subscriber = Subscriber::create(['email' => 'c@example.com', 'status' => 'confirmed', 'confirmed_at' => now()]);

        $this->get(route('newsletter.unsubscribe', $subscriber->token))
            ->assertOk()
            ->assertSee('unsubscribed');

        $this->assertDatabaseHas('subscribers', ['email' => 'c@example.com', 'status' => 'unsubscribed']);
    }

    public function test_an_unknown_confirm_token_is_not_found(): void
    {
        $this->get(route('newsletter.confirm', 'nope-not-a-real-token'))->assertNotFound();
    }
}
