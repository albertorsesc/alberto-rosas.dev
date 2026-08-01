<?php

namespace App\Jobs;

use App\Models\Subscriber;
use App\Services\Resend\Audience;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Mirrors a confirmed subscriber into the Resend audience off the request path.
 * The add is an idempotent upsert, so a retry is safe. A no-op when Resend is
 * unconfigured.
 */
class SyncSubscriberToResend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Subscriber $subscriber) {}

    public function handle(Audience $audience): void
    {
        $audience->add($this->subscriber);
    }
}
