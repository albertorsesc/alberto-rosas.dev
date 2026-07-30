<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubscriptionWelcome extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $unsubscribeUrl) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: "You're subscribed");
    }

    public function content(): Content
    {
        return new Content(markdown: 'mail.subscribe.welcome');
    }
}
