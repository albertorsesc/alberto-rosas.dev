<?php

use App\Http\Controllers\Blog\ImageController;
use App\Http\Controllers\Blog\IndexController;
use App\Http\Controllers\Blog\ShowController;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Middleware\ShareErrorsFromSession;

// max_age=0 + etag: browsers revalidate every request (cheap 304s) instead of
// serving stale HTML for 2h. With max_age=7200, any Vite rebuild deleted the
// hashed CSS that cached blog HTML still referenced, rendering it unstyled.
// If Cloudflare edge caching is enabled for HTML, purge on deploy instead.
Route::middleware('cache.headers:public;max_age=0;etag')
    ->withoutMiddleware([
        ShareErrorsFromSession::class,
        StartSession::class,
        PreventRequestForgery::class,
    ])
    ->group(function () {
        Route::get('blog/img/{path}', ImageController::class)
            ->name('prezet.image')
            ->where('path', '.*');

        Route::get('blog', IndexController::class)->name('prezet.index');

        Route::get('blog/{slug}', ShowController::class)
            ->name('prezet.show')
            ->where('slug', '.*');
        // https://laravel.com/docs/12.x/routing#parameters-encoded-forward-slashes
    });
