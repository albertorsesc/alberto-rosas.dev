<?php

namespace App\Livewire;

use App\Models\Site\Contact;
use App\Notifications\NewContactSubmissionNotification;
use App\Services\Slack\SlackNotifier;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Log;
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
        $key = 'contact-form:'.request()->ip();

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

        // Persistence failure must reach the user as an in-form message, not a
        // raw Livewire error overlay. Input is preserved and the rate limit is
        // not burned, so retrying costs nothing.
        try {
            $contact = Contact::create(
                $this->only(['name', 'email', 'message'])
            );
        } catch (\Throwable $e) {
            Log::error('Contact form persistence failed', ['error' => $e->getMessage()]);
            $this->addError('form', "Something went wrong on my end. Email me directly at alberto.rsesc@protonmail.com and I'll get back to you.");

            return;
        }

        RateLimiter::hit($key, 3600);

        // Slack is the notification layer; the DB row above is the source of truth.
        // SlackNotifier no-ops without a token and swallows a Slack outage, so a
        // failed ping never 500s the form.
        app(SlackNotifier::class)->send(
            new NewContactSubmissionNotification($contact, request()->ip())
        );

        session()->flash('status', "Thanks, {$this->name}! I'll get back to you soon.");

        $this->reset();
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
