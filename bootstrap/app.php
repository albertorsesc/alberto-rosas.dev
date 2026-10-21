<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Livewire\Features\SupportFileUploads\MissingFileUploadsTraitException;
use Psr\Log\LogLevel;

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
        // Bots replay a component's Livewire snapshot with a `_startUpload`
        // call. No component here has a file input, so Livewire refuses the
        // call with this exception. It is answered as a client error and
        // recorded at warning: the log keeps a trace, and nothing reaches
        // Slack, which forwards error level and above.
        $exceptions->level(MissingFileUploadsTraitException::class, LogLevel::WARNING);
        $exceptions->render(fn (MissingFileUploadsTraitException $e, Request $request) => response()->json(
            ['message' => 'File uploads are not accepted.'], 400
        ));
    })->create();
