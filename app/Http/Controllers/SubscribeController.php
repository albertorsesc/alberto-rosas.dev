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
            if (! $subscriber->exists) {
                $subscriber->fill(['source' => $source, 'status' => 'pending'])->save();
            }

            Mail::to($subscriber->email)->send(
                new ConfirmSubscription(route('newsletter.confirm', $subscriber->token))
            );
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
