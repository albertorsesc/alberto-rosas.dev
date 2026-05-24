<?php

namespace App\Livewire;

use App\Models\Site\Contact;
use App\Notifications\NewContactSubmissionNotification;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name = '';

    public string $email = '';

    public string $message = '';

    public string $website = ''; // Honeypot

    public function save(): void
    {
        $key = 'contact-form:' . request()->ip();

        // Honeypot — bots fill this in, humans don't see it.
        // Burn rate-limit budget so spammers can't pound the endpoint.
        if ($this->website !== '') {
            RateLimiter::hit($key, 3600);
            session()->flash('status', "Thanks! I'll get back to you soon.");
            $this->reset();
            return;
        }

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $this->addError('message', 'Too many messages. Please try again later.');
            return;
        }

        $this->validate();

        $contact = Contact::create(
            $this->only(['name', 'email', 'message'])
        );

        RateLimiter::hit($key, 3600);

        $this->notifySlack($contact);

        session()->flash('status', "Thanks, {$this->name}! I'll get back to you soon.");

        $this->reset();
    }

    /**
     * Notify Slack of a new submission. No-ops if the bot token is not configured,
     * so the form keeps working in environments where Slack isn't wired up yet.
     *
     * Catches \Throwable (broader than \Exception) intentionally: a Slack outage
     * or transport-layer fatal must never 500 the form for the user. The contact
     * row is already persisted by the time we get here — the DB is the source of
     * truth, Slack is the notification layer.
     */
    protected function notifySlack(Contact $contact): void
    {
        $token = config('services.slack.notifications.bot_user_oauth_token');
        $channel = config('services.slack.notifications.channel');

        if (empty($token) || empty($channel)) {
            return;
        }

        try {
            Notification::route('slack', $channel)
                ->notify(new NewContactSubmissionNotification($contact, request()->ip()));
        } catch (\Throwable $e) {
            Log::warning('Slack notification dispatch failed for contact form submission', [
                'contact_id' => $contact->id,
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function render(): View|Factory|Application
    {
        return view('livewire.contact-form');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            // `email:rfc` runs egulias/email-validator's strict RFC 5321/5322 check
            // without the DNS roundtrip that the `dns` modifier adds. DNS lookups
            // are slow, susceptible to local resolver quirks, and reject legitimate
            // emails on certain MX configurations.
            'email' => ['required', 'max:255', 'email:rfc'],
            'message' => ['required', 'min:10', 'max:5000'],
        ];
    }
}
