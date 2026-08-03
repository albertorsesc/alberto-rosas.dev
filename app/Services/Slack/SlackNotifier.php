<?php

namespace App\Services\Slack;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification as NotificationFacade;

/**
 * Single place that sends Slack notifications. No-ops when the bot token/channel
 * are absent (local dev, tests) and never lets a Slack outage bubble up: the
 * caller's own success/failure is independent of whether the ping landed.
 */
class SlackNotifier
{
    public function enabled(): bool
    {
        return filled(config('services.slack.notifications.bot_user_oauth_token'))
            && filled(config('services.slack.notifications.channel'));
    }

    public function send(Notification $notification): void
    {
        if (! $this->enabled()) {
            return;
        }

        try {
            NotificationFacade::route('slack', config('services.slack.notifications.channel'))
                ->notify($notification);
        } catch (\Throwable $e) {
            Log::warning('Slack notification dispatch failed', [
                'notification' => $notification::class,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
