<?php

namespace App\Listeners;

use App\Notifications\SystemFailureNotification;
use App\Services\Slack\SlackNotifier;
use Illuminate\Log\Events\MessageLogged;
use Illuminate\Support\Str;

/**
 * Forwards every error-level (and worse) log record to Slack. That single hook
 * covers both explicit failures the app catches and logs (a mail send, a lost
 * lead) and every unhandled exception, since Laravel's handler logs those at
 * error. Warnings stay out so transient blips (a GitHub fetch) don't spam.
 */
class ReportErrorToSlack
{
    /** Reentrancy guard: sending an alert must never re-trigger this listener. */
    private static bool $sending = false;

    private const ALERT_LEVELS = ['error', 'critical', 'alert', 'emergency'];

    public function __construct(private SlackNotifier $slack) {}

    public function handle(MessageLogged $event): void
    {
        if (self::$sending) {
            return;
        }
        if (! config('services.slack.notifications.alert_on_error', true)) {
            return;
        }
        if (! in_array($event->level, self::ALERT_LEVELS, true)) {
            return;
        }

        self::$sending = true;

        try {
            $this->slack->send(new SystemFailureNotification(
                'Site error: '.Str::limit($event->message, 100),
                $this->context($event),
            ));
        } finally {
            self::$sending = false;
        }
    }

    /**
     * @return array<string, string>
     */
    private function context(MessageLogged $event): array
    {
        $context = ['level' => $event->level, 'message' => $event->message];

        $exception = $event->context['exception'] ?? null;
        if ($exception instanceof \Throwable) {
            $context['exception'] = $exception::class;
            $context['at'] = $exception->getFile().':'.$exception->getLine();
        }

        return $context;
    }
}
