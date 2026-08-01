<?php

namespace App\Services\Resend;

use App\Models\Subscriber;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Pushes confirmed subscribers into a Resend audience for broadcasts. Uses the
 * REST API directly (no SDK), and no-ops when the key or audience id are absent,
 * so local dev and tests never hit the network. The app DB stays the source of
 * truth; this is a one-way mirror for sending.
 */
class Audience
{
    public function __construct(
        private readonly ?string $key = null,
        private readonly ?string $audienceId = null,
    ) {}

    public function enabled(): bool
    {
        return filled($this->key) && filled($this->audienceId);
    }

    /** Add (or upsert) a confirmed subscriber. Returns true on a successful sync. */
    public function add(Subscriber $subscriber): bool
    {
        if (! $this->enabled()) {
            return false;
        }

        // Always send unsubscribed=false so a previously-unsubscribed contact who
        // re-confirms is reactivated in Resend. array_filter would drop the `false`
        // (and a null name) before the request ever went out. first_name is included
        // only when actually set.
        $payload = ['email' => $subscriber->email, 'unsubscribed' => false];
        if (filled($subscriber->name)) {
            $payload['first_name'] = $subscriber->name;
        }

        try {
            $response = Http::withToken($this->key)
                ->timeout(8)
                ->post("https://api.resend.com/audiences/{$this->audienceId}/contacts", $payload);

            if ($response->successful()) {
                $subscriber->forceFill(['synced_at' => now()])->save();

                return true;
            }

            Log::warning('Resend audience sync failed', [
                'status' => $response->status(),
                'email' => $subscriber->email,
            ]);
        } catch (\Throwable $e) {
            Log::warning('Resend audience sync error', ['error' => $e->getMessage()]);
        }

        return false;
    }
}
