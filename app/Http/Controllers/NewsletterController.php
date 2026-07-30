<?php

namespace App\Http\Controllers;

use App\Mail\SubscriptionWelcome;
use App\Models\Subscriber;
use App\Notifications\NewSubscriberNotification;
use App\Services\Resend\Audience;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class NewsletterController extends Controller
{
    /**
     * Double opt-in confirm: mark confirmed, mirror to the Resend audience (no-op
     * if unconfigured), send the welcome, and ping Slack. Idempotent, a second
     * visit to an already-confirmed token does nothing.
     */
    public function confirm(string $token)
    {
        $subscriber = Subscriber::where('token', $token)->firstOrFail();

        if (! $subscriber->isConfirmed()) {
            $subscriber->markConfirmed();
            app(Audience::class)->add($subscriber);
            Mail::to($subscriber->email)->send(
                new SubscriptionWelcome(route('newsletter.unsubscribe', $subscriber->token))
            );
            $this->notifySlack($subscriber);
        }

        return view('pages.newsletter-status', ['state' => 'confirmed']);
    }

    public function unsubscribe(string $token)
    {
        Subscriber::where('token', $token)->firstOrFail()->markUnsubscribed();

        return view('pages.newsletter-status', ['state' => 'unsubscribed']);
    }

    /**
     * Ping Slack when a subscriber confirms. No-ops without a bot token/channel,
     * and never lets a Slack failure break the confirmation page.
     */
    protected function notifySlack(Subscriber $subscriber): void
    {
        $token = config('services.slack.notifications.bot_user_oauth_token');
        $channel = config('services.slack.notifications.channel');

        if (empty($token) || empty($channel)) {
            return;
        }

        try {
            Notification::route('slack', $channel)
                ->notify(new NewSubscriberNotification($subscriber));
        } catch (\Throwable $e) {
            Log::warning('Slack notification dispatch failed for new subscriber', [
                'subscriber_id' => $subscriber->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
