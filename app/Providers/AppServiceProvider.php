<?php

namespace App\Providers;

use App\Listeners\ReportErrorToSlack;
use App\Services\Github\Client;
use App\Services\Github\Pins;
use Illuminate\Log\Events\MessageLogged;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Prezet v1 ships its own SEO and binds `seo` to its service, which would
        // hijack the archtechx/laravel-seo manager the whole site uses (seo()->title,
        // <x-seo::meta>). This provider loads after both packages, so re-assert
        // archtechx as the authoritative `seo` binding.
        $this->app->scoped('seo', \ArchTech\SEO\SEOManager::class);

        $this->app->singleton(Client::class, fn () => new Client(
            config('services.github.token'),
            config('services.github.user'),
        ));

        $this->app->singleton(Pins::class, fn ($app) => new Pins(
            $app->make(Client::class),
        ));

        $this->app->singleton(\App\Services\Resend\Audience::class, fn () => new \App\Services\Resend\Audience(
            config('services.resend.key'),
            config('services.resend.audience_id'),
        ));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // The newsletter's from address is send-only; route replies to a real
        // inbox instead of letting them bounce. No-ops until a reply-to is set.
        if ($replyTo = config('mail.reply_to.address')) {
            Mail::alwaysReplyTo($replyTo, config('mail.reply_to.name'));
        }

        // Mirror error-level logs (and unhandled exceptions) to Slack. Skipped
        // under tests so the suite never reaches for the network; the listener is
        // exercised directly in its own test.
        if (! $this->app->runningUnitTests()) {
            Event::listen(MessageLogged::class, ReportErrorToSlack::class);
        }

        // Site-wide SEO defaults. Per-page calls (in each view / the blog's
        // SetSeo action) override these; anything not overridden falls back here.
        seo()
            ->site('Alberto Rosas')
            ->title('Alberto Rosas · AI & Agentic Systems Engineer')
            ->description('AI & Agentic Systems Engineer with 12+ years in software and 5+ in production AI. Agentic systems, hybrid retrieval, and eval-first delivery. Based in Mexico, US-timezone friendly.')
            ->image(url('/og-image.png'))
            ->locale('en_US')
            ->twitter()
            ->twitterCreator('@bcryp7');
    }
}
