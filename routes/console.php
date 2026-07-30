<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Mirror the GitHub profile pins into the homepage experiments section weekly.
// Re-pinning on GitHub reflects on the next run; `php artisan github:pins:refresh`
// forces it immediately.
Schedule::command('github:pins:refresh')->weekly();

// Keep sitemap.xml current (new blog posts, updated dates). Also run at deploy.
Schedule::command('sitemap:generate')->daily();
