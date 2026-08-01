<?php

use App\Services\Github\Pins;
use BenBjurstrom\Prezet\Models\Document;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Pins $pins) {
    // The homepage stays up even if the Prezet index is missing or broken;
    // the writing section simply drops out.
    try {
        $published = Document::where('draft', false);
        $postCount = $published->count();
        $posts = $published->orderBy('created_at', 'desc')
            ->take(3)
            ->get()
            ->map(fn ($doc) => $doc->frontmatter);
    } catch (\Throwable) {
        $posts = collect();
        $postCount = 0;
    }

    // Experiments mirror the GitHub profile pins. Never breaks the page: on any
    // failure the service returns [] and the section hides.
    try {
        $experiments = $pins->cards();
    } catch (\Throwable) {
        $experiments = [];
    }

    return view('welcome', [
        'posts' => $posts,
        'postCount' => $postCount,
        'experiments' => $experiments,
    ]);
});

Route::view('/work', 'pages.work')->name('work');
Route::view('/about', 'pages.about')->name('about');
Route::view('/now', 'pages.now')->name('now');
Route::view('/uses', 'pages.uses')->name('uses');

// Newsletter capture. Rate-limited and CSRF-exempt (see bootstrap/app.php) so it
// works from cached blog pages; double opt-in makes forged posts inert.
Route::post('/newsletter/subscribe', \App\Http\Controllers\SubscribeController::class)
    ->middleware('throttle:6,1')
    ->name('newsletter.subscribe');

// Double opt-in confirm / unsubscribe. The emailed link is the GET, which only
// renders an interstitial with a button; the POST performs the mutation. This
// stops mail scanners that prefetch links from auto-confirming a forged signup or
// silently unsubscribing a real subscriber. CSRF applies normally (these pages are
// session-backed, unlike the cached-page subscribe endpoint).
Route::get('/newsletter/confirm/{token}', [\App\Http\Controllers\NewsletterController::class, 'showConfirm'])
    ->name('newsletter.confirm');
Route::post('/newsletter/confirm/{token}', [\App\Http\Controllers\NewsletterController::class, 'confirm'])
    ->name('newsletter.confirm.submit');
Route::get('/newsletter/unsubscribe/{token}', [\App\Http\Controllers\NewsletterController::class, 'showUnsubscribe'])
    ->name('newsletter.unsubscribe');
Route::post('/newsletter/unsubscribe/{token}', [\App\Http\Controllers\NewsletterController::class, 'unsubscribe'])
    ->name('newsletter.unsubscribe.submit');

// Blog RSS feed. Registered before Prezet's blog/{slug} catch-all so "feed" isn't
// matched as a slug. Prezet 0.8.8 ships no feed of its own.
Route::get('/blog/feed', function () {
    $docs = \BenBjurstrom\Prezet\Models\Document::where('draft', false)
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(fn ($doc) => $doc->frontmatter);

    return response()
        ->view('feed', ['docs' => $docs])
        ->header('Content-Type', 'application/rss+xml; charset=utf-8');
})->name('blog.feed');

require __DIR__.'/prezet.php';
