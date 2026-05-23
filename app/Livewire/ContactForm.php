<?php

namespace App\Livewire;

use App\Models\Site\Contact;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
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

        Contact::create(
            $this->only(['name', 'email', 'message'])
        );

        RateLimiter::hit($key, 3600);

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
            'email' => ['required', 'max:255', 'email:rfc,dns'],
            'message' => ['required', 'min:10', 'max:5000'],
        ];
    }
}
