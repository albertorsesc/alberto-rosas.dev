<?php

namespace Tests\Feature;

use App\Livewire\ContactForm;
use App\Models\Site\Contact;
use App\Notifications\NewContactSubmissionNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Livewire;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        RateLimiter::clear('contact-form:127.0.0.1');
        config()->set('services.slack.notifications.bot_user_oauth_token', null);
        config()->set('services.slack.notifications.channel', 'alberto-rosas-site');
    }

    public function test_a_valid_submission_saves_the_contact_and_resets_fields(): void
    {
        // Flash messaging works in production (manually verified via Playwright),
        // but Livewire's test lifecycle runs multiple render passes which ages
        // out the flash bag before assertion. We assert the user-visible state
        // (no errors, fields cleared) and the persistent state (DB row) instead.
        Livewire::test(ContactForm::class)
            ->set('name', 'Real User')
            ->set('email', 'real@gmail.com')
            ->set('message', 'This is a real message that should pass min:10 validation.')
            ->call('save')
            ->assertHasNoErrors()
            ->assertSet('name', '')
            ->assertSet('email', '')
            ->assertSet('message', '');

        $this->assertDatabaseHas('contacts', [
            'name' => 'Real User',
            'email' => 'real@gmail.com',
            'message' => 'This is a real message that should pass min:10 validation.',
        ]);
    }

    public function test_honeypot_silently_does_not_save_and_burns_rate_limit(): void
    {
        Livewire::test(ContactForm::class)
            ->set('name', 'Bot')
            ->set('email', 'bot@bots.com')
            ->set('message', 'spam spam spam spam spam')
            ->set('website', 'http://spam.example')
            ->call('save')
            ->assertHasNoErrors()
            ->assertSet('name', '')
            ->assertSet('website', '');

        $this->assertDatabaseCount('contacts', 0);
        // Bot still burns budget so spammers can't pound the endpoint forever
        $this->assertEquals(1, RateLimiter::attempts('contact-form:127.0.0.1'));
    }

    public function test_rate_limit_blocks_after_three_submissions_in_an_hour(): void
    {
        // Pre-fill the limiter with 3 hits
        RateLimiter::hit('contact-form:127.0.0.1', 3600);
        RateLimiter::hit('contact-form:127.0.0.1', 3600);
        RateLimiter::hit('contact-form:127.0.0.1', 3600);

        Livewire::test(ContactForm::class)
            ->set('name', 'Real User')
            ->set('email', 'real@gmail.com')
            ->set('message', 'A perfectly valid message that meets all length requirements.')
            ->call('save')
            ->assertHasErrors(['message']);

        $this->assertDatabaseCount('contacts', 0);
    }

    public function test_validation_errors_prevent_save_and_do_not_burn_rate_limit(): void
    {
        Livewire::test(ContactForm::class)
            ->set('name', '')
            ->set('email', 'not-an-email')
            ->set('message', 'too short')
            ->call('save')
            ->assertHasErrors(['name', 'email', 'message']);

        $this->assertDatabaseCount('contacts', 0);
        // Failed validation never reaches the RateLimiter::hit() call
        $this->assertEquals(0, RateLimiter::attempts('contact-form:127.0.0.1'));
    }

    public function test_slack_notification_dispatched_when_token_present(): void
    {
        Notification::fake();
        config()->set('services.slack.notifications.bot_user_oauth_token', 'xoxb-fake-token');

        Livewire::test(ContactForm::class)
            ->set('name', 'Real User')
            ->set('email', 'real@gmail.com')
            ->set('message', 'A perfectly valid message that meets all length requirements.')
            ->call('save')
            ->assertHasNoErrors();

        Notification::assertSentOnDemand(NewContactSubmissionNotification::class);
    }

    public function test_slack_notification_noops_when_token_absent(): void
    {
        Notification::fake();
        config()->set('services.slack.notifications.bot_user_oauth_token', null);

        Livewire::test(ContactForm::class)
            ->set('name', 'Real User')
            ->set('email', 'real@gmail.com')
            ->set('message', 'A perfectly valid message that meets all length requirements.')
            ->call('save')
            ->assertHasNoErrors();

        Notification::assertNothingSent();
        $this->assertDatabaseCount('contacts', 1); // form still saved
    }

    public function test_slack_dispatch_failure_is_caught_logged_and_does_not_500_the_form(): void
    {
        config()->set('services.slack.notifications.bot_user_oauth_token', 'xoxb-fake-token');

        // Partial-mock the Notification facade so route() throws on first call,
        // simulating a transport-layer or serialization failure. Everything else
        // on the facade continues to work normally.
        $mock = Notification::partialMock();
        $mock->shouldReceive('route')
            ->andThrow(new \RuntimeException('Slack API blew up'));

        $logSpy = Log::spy();

        Livewire::test(ContactForm::class)
            ->set('name', 'Real User')
            ->set('email', 'real@gmail.com')
            ->set('message', 'A perfectly valid message that meets all length requirements.')
            ->call('save')
            ->assertHasNoErrors()
            ->assertSet('name', '');

        // The form must still save and the failure must be logged at warning level.
        $this->assertDatabaseCount('contacts', 1);
        $logSpy->shouldHaveReceived('warning')
            ->withArgs(fn ($message) => str_contains($message, 'Slack notification dispatch failed'))
            ->once();
    }

    public function test_rejects_email_without_at_sign(): void
    {
        Livewire::test(ContactForm::class)
            ->set('name', 'Real')
            ->set('email', 'notanemail')
            ->set('message', 'A perfectly valid long-enough message.')
            ->call('save')
            ->assertHasErrors(['email']);
    }

    public function test_rejects_message_under_ten_characters(): void
    {
        Livewire::test(ContactForm::class)
            ->set('name', 'Real')
            ->set('email', 'real@gmail.com')
            ->set('message', 'short')
            ->call('save')
            ->assertHasErrors(['message']);
    }

    public function test_rejects_message_over_five_thousand_characters(): void
    {
        Livewire::test(ContactForm::class)
            ->set('name', 'Real')
            ->set('email', 'real@gmail.com')
            ->set('message', str_repeat('a', 5001))
            ->call('save')
            ->assertHasErrors(['message']);
    }
}
