<?php

namespace App\Console\Commands;

use Prezet\Prezet\Models\Document;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

/**
 * Builds public/sitemap.xml from the static routes plus published blog posts,
 * using the real APP_URL. Run at deploy (and on a schedule) so the output never
 * ships with local .test hostnames the way the old committed sitemap did.
 */
class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate public/sitemap.xml from routes and published blog posts';

    public function handle(): int
    {
        $sitemap = Sitemap::create();

        foreach ([
            ['/', 'daily', 1.0],
            ['/work', 'monthly', 0.9],
            ['/about', 'monthly', 0.8],
            ['/blog', 'weekly', 0.7],
            ['/now', 'weekly', 0.5],
            ['/uses', 'monthly', 0.4],
        ] as [$path, $freq, $priority]) {
            $sitemap->add(
                Url::create(url($path))
                    ->setChangeFrequency($freq)
                    ->setPriority($priority)
            );
        }

        try {
            Document::where('draft', false)->get()->each(function (Document $doc) use ($sitemap) {
                $sitemap->add(
                    Url::create(route('prezet.show', $doc->frontmatter->slug))
                        ->setLastModificationDate($doc->updated_at ?? $doc->created_at)
                        ->setChangeFrequency('monthly')
                        ->setPriority(0.6)
                );
            });
        } catch (\Throwable $e) {
            $this->warn('Blog posts skipped: '.$e->getMessage());
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));
        $this->info('Wrote '.public_path('sitemap.xml'));

        return self::SUCCESS;
    }
}
