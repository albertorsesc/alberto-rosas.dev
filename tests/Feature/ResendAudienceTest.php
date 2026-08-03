<?php

namespace Tests\Feature;

use App\Models\Subscriber;
use App\Services\Resend\Audience;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ResendAudienceTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_always_sends_unsubscribed_false_and_omits_a_null_name(): void
    {
        Http::fake(['api.resend.com/*' => Http::response(['id' => 'contact-1'], 200)]);
        $subscriber = Subscriber::create(['email' => 'r@example.com', 'status' => 'confirmed', 'confirmed_at' => now()]);

        (new Audience('key', 'aud-id'))->add($subscriber);

        Http::assertSent(function ($request) {
            $body = $request->data();

            return $request->url() === 'https://api.resend.com/audiences/aud-id/contacts'
                && array_key_exists('unsubscribed', $body)   // not stripped by array_filter
                && $body['unsubscribed'] === false            // reactivates a re-subscribe
                && ! array_key_exists('first_name', $body);   // null name omitted
        });
    }

    public function test_add_includes_first_name_when_set(): void
    {
        Http::fake(['api.resend.com/*' => Http::response(['id' => 'contact-1'], 200)]);
        $subscriber = Subscriber::create(['email' => 'r@example.com', 'name' => 'Ada', 'status' => 'confirmed', 'confirmed_at' => now()]);

        (new Audience('key', 'aud-id'))->add($subscriber);

        Http::assertSent(fn ($request) => ($request->data()['first_name'] ?? null) === 'Ada');
    }

    public function test_add_is_a_noop_when_unconfigured(): void
    {
        Http::fake();
        $subscriber = Subscriber::create(['email' => 'r@example.com', 'status' => 'confirmed', 'confirmed_at' => now()]);

        $this->assertFalse((new Audience(null, null))->add($subscriber));

        Http::assertNothingSent();
    }
}
