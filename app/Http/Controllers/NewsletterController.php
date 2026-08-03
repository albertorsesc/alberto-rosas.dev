<?php

namespace App\Http\Controllers;

use App\Jobs\SyncSubscriberToResend;
use App\Mail\SubscriptionWelcome;
use App\Models\Subscriber;
use App\Notifications\NewSubscriberNotification;
use App\Services\Slack\SlackNotifier;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    /**
     * The emailed confirm link (GET). Renders an interstitial with a POST button
     * rather than confirming on the click itself, so a mail security scanner that
     * prefetches the link can't auto-confirm a forged signup. An already-confirmed
     * token skips straight to the success page.
     */
    public function showConfirm(string $token)
    {
        $subscriber = Subscriber::where('token', $token)->firstOrFail();

        return $subscriber->isConfirmed()
            ? view('pages.newsletter-status', ['state' => 'confirmed'])
            : view('pages.newsletter-status', ['state' => 'confirm-prompt', 'token' => $token]);
    }

    /**
     * Double opt-in confirm (POST from the interstitial): mark confirmed, then defer
     * every side effect so the click returns instantly and each retries on its own,
     * the Resend audience sync, the welcome mail, and the Slack ping (all queued).
     * Idempotent, a second POST for an already-confirmed token does nothing.
     */
    public function confirm(string $token)
    {
        $subscriber = Subscriber::where('token', $token)->firstOrFail();

        if (! $subscriber->isConfirmed()) {
            $subscriber->markConfirmed();

            SyncSubscriberToResend::dispatch($subscriber);
            Mail::to($subscriber->email)->send(
                new SubscriptionWelcome(route('newsletter.unsubscribe', $subscriber->token))
            );
            app(SlackNotifier::class)->send(new NewSubscriberNotification($subscriber));
        }

        return view('pages.newsletter-status', ['state' => 'confirmed']);
    }

    /**
     * The emailed unsubscribe link (GET). Renders an interstitial with a POST button
     * so a link prefetch can't silently unsubscribe a real subscriber. An already-
     * unsubscribed token skips straight to the confirmation page.
     */
    public function showUnsubscribe(string $token)
    {
        $subscriber = Subscriber::where('token', $token)->firstOrFail();

        return $subscriber->isUnsubscribed()
            ? view('pages.newsletter-status', ['state' => 'unsubscribed'])
            : view('pages.newsletter-status', ['state' => 'unsubscribe-prompt', 'token' => $token]);
    }

    public function unsubscribe(string $token)
    {
        Subscriber::where('token', $token)->firstOrFail()->markUnsubscribed();

        return view('pages.newsletter-status', ['state' => 'unsubscribed']);
    }
}
