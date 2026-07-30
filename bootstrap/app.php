<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // The newsletter form lives on cached, cookie-stripped blog pages where a
        // per-session CSRF token can't be issued. The endpoint is rate-limited and
        // uses double opt-in, so a forged post can at most email a confirmation the
        // recipient must still click.
        $middleware->validateCsrfTokens(except: [
            'newsletter/subscribe',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
