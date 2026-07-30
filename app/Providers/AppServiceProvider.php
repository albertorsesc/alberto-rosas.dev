<?php

namespace App\Providers;

use App\Services\Github\Client;
use App\Services\Github\Pins;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Client::class, fn () => new Client(
            config('services.github.token'),
            config('services.github.user'),
        ));

        $this->app->singleton(Pins::class, fn ($app) => new Pins(
            $app->make(Client::class),
            config('services.github.pins_ttl_hours'),
        ));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
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
