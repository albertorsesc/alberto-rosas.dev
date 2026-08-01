<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmSubscription;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SubscribeController extends Controller
{
    /** Minimum gap between confirmation-email resends to the same address. */
    private const RESEND_COOLDOWN_MINUTES = 5;

    /**
     * Accepts a newsletter signup from any placement (home, footer, blog post).
     * Progressive enhancement: answers JSON to `fetch`, redirects back otherwise.
     * Double opt-in, so this only ever creates a pending record and emails a
     * confirmation; nothing is added to the audience until the link is clicked.
     */
    public function __invoke(Request $request)
    {
        $source = (string) $request->input('source', 'site');

        // Honeypot: a field humans never see. If a bot filled it, feign success
        // and do nothing.
        if (filled($request->input('website'))) {
            return $this->done($request, $source);
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return $request->expectsJson()
                ? response()->json(['errors' => $validator->errors()], 422)
                : back()->withErrors($validator)->withInput();
        }

        $email = Str::lower(trim($request->input('email')));
        $subscriber = Subscriber::firstOrNew(['email' => $email]);

        // Already confirmed: report success without a duplicate email, and without
        // revealing that the address is already on the list.
        if (! ($subscriber->exists && $subscriber->isConfirmed())) {
            // Per-email cooldown: skip the send if a confirmation went out within the
            // window. Without it, a repeated (forged) submit to this CSRF-exempt
            // endpoint could bomb a victim's inbox, since the per-IP throttle doesn't
            // stop a proxy pool.
            $recentlyEmailed = $subscriber->confirmation_sent_at
                && $subscriber->confirmation_sent_at->gt(now()->subMinutes(self::RESEND_COOLDOWN_MINUTES));

            if (! $recentlyEmailed) {
                if (! $subscriber->exists) {
                    $subscriber->fill(['source' => $source, 'status' => 'pending']);
                }
                $subscriber->forceFill(['confirmation_sent_at' => now()])->save();

                // Queued (ConfirmSubscription is ShouldQueue): capturing the record
                // above is the certain part. Delivery happens in the worker and
                // retries on a transport hiccup, so a signup never fails for a mail
                // blip; a job that exhausts retries surfaces via the error->Slack
                // listener. The user just sees "check your inbox".
                Mail::to($subscriber->email)->send(
                    new ConfirmSubscription(route('newsletter.confirm', $subscriber->token))
                );
            }
        }

        return $this->done($request, $source);
    }

    private function done(Request $request, string $source): \Symfony\Component\HttpFoundation\Response
    {
        return $request->expectsJson()
            ? response()->json(['ok' => true])
            : back()->with('subscribed', $source);
    }
}
