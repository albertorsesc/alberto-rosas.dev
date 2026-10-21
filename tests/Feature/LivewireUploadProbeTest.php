<?php

namespace Tests\Feature;

use App\Livewire\ContactForm;
use Illuminate\Log\Events\MessageLogged;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Livewire\Features\SupportFileUploads\MissingFileUploadsTraitException;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * Bots replay the contact form's Livewire snapshot with a `_startUpload` call,
 * the request a browser sends when a file input changes. The form has no file
 * input, so Livewire refuses the call. The refusal must read as the client's
 * mistake: a 400, a warning in the log rather than an error, no Slack alert.
 */
class LivewireUploadProbeTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config()->set('services.slack.notifications.bot_user_oauth_token', 'test-token');
        config()->set('services.slack.notifications.channel', '#alerts');
        config()->set('services.slack.notifications.alert_on_error', true);
    }

    public function test_a_file_upload_call_against_the_contact_form_is_a_400_and_not_an_alert(): void
    {
        Notification::fake();
        $records = [];
        Event::listen(MessageLogged::class, function (MessageLogged $event) use (&$records): void {
            $exception = $event->context['exception'] ?? null;
            $records[] = [$event->level, $exception instanceof \Throwable ? $exception::class : null];
        });

        $snapshot = Livewire::test(ContactForm::class)->snapshot;

        $response = $this->postJson('/livewire/update', [
            'components' => [[
                'snapshot' => json_encode($snapshot),
                'updates' => [],
                'calls' => [[
                    'path' => '',
                    'method' => '_startUpload',
                    'params' => ['attachment', ['name' => 'shell.php', 'size' => 12, 'type' => 'application/x-php'], false],
                ]],
            ]],
        ]);

        $response->assertStatus(400)->assertJson(['message' => 'File uploads are not accepted.']);
        $this->assertContains(['warning', MissingFileUploadsTraitException::class], $records);
        $this->assertNotContains('error', array_column($records, 0));
        Notification::assertNothingSent();
    }
}
