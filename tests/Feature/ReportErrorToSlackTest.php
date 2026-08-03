<?php

namespace Tests\Feature;

use App\Listeners\ReportErrorToSlack;
use App\Notifications\SystemFailureNotification;
use App\Services\Slack\SlackNotifier;
use Illuminate\Log\Events\MessageLogged;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ReportErrorToSlackTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config()->set('services.slack.notifications.bot_user_oauth_token', 'test-token');
        config()->set('services.slack.notifications.channel', '#alerts');
        config()->set('services.slack.notifications.alert_on_error', true);
    }

    private function fire(string $level, string $message = 'boom', array $context = []): void
    {
        (new ReportErrorToSlack(new SlackNotifier))->handle(
            new MessageLogged($level, $message, $context)
        );
    }

    public function test_it_forwards_error_level_logs_to_slack(): void
    {
        Notification::fake();

        $this->fire('error', 'Something broke');

        Notification::assertSentOnDemand(SystemFailureNotification::class);
    }

    public function test_it_ignores_warning_level_logs(): void
    {
        Notification::fake();

        $this->fire('warning', 'just a heads up');

        Notification::assertNothingSent();
    }

    public function test_the_kill_switch_silences_it(): void
    {
        config()->set('services.slack.notifications.alert_on_error', false);
        Notification::fake();

        $this->fire('error', 'Something broke');

        Notification::assertNothingSent();
    }

    public function test_it_noops_without_a_slack_token(): void
    {
        config()->set('services.slack.notifications.bot_user_oauth_token', null);
        Notification::fake();

        $this->fire('error', 'Something broke');

        Notification::assertNothingSent();
    }
}
