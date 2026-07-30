<?php

namespace App\Console\Commands;

use App\Services\Github\Pins;
use Illuminate\Console\Command;

class RefreshGithubPins extends Command
{
    protected $signature = 'github:pins:refresh';

    protected $description = 'Refresh the cached GitHub profile pins shown in the homepage experiments section';

    public function handle(Pins $pins): int
    {
        $count = $pins->refresh();

        $this->info("Refreshed {$count} pinned repositories.");

        return self::SUCCESS;
    }
}
