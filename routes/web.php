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

require __DIR__.'/prezet.php';
