<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// GitHub pins are refreshed manually from local, like reindexing the blog: run
// `php artisan github:pins:refresh` after re-pinning or adding a repo, then commit
// database/github-pins.json. Prod serves that file and never calls GitHub.

// Keep sitemap.xml current (new blog posts, updated dates). Also run at deploy.
Schedule::command('sitemap:generate')->daily();
