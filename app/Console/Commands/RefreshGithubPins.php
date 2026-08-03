<?php

namespace App\Console\Commands;

use App\Services\Github\Pins;
use Illuminate\Console\Command;

class RefreshGithubPins extends Command
{
    protected $signature = 'github:pins:refresh';

    protected $description = 'Refresh the committed GitHub pins file (run locally, then commit) for the homepage experiments section';

    public function handle(Pins $pins): int
    {
        $count = $pins->refresh();

        if ($count === 0) {
            $this->warn('No pins fetched; kept the existing file. Is `gh` authed (or GITHUB_TOKEN set)?');

            return self::SUCCESS;
        }

        $this->info("Refreshed {$count} pinned repositories. Commit database/github-pins.json to publish.");

        return self::SUCCESS;
    }
}
