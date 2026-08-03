<?php

namespace App\Services\Github;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Turns the pinned repositories into cards for the homepage "experiments" grid.
 *
 * Pins are generated locally (`php artisan github:pins:refresh`, which uses the
 * authed `gh` CLI, no token needed) into a committed JSON file, then served from
 * that file. Same "index locally, commit, serve" flow as the blog: no GitHub call
 * or token at request time. Re-run and commit when you re-pin or add a repo.
 */
class Pins
{
    /** Slugs rendered upper-case (MCP, CLI, …) instead of Title-cased. */
    private const ACRONYMS = ['mcp', 'cli', 'ai', 'api', 'sql', 'llm', 'rag', 'ui', 'ml'];

    /** Build/infra "languages" GitHub reports that aren't a tech stack. */
    private const NON_STACK = [
        'dockerfile', 'makefile', 'shell', 'batchfile', 'cmake',
        'roff', 'dotenv', 'procfile', 'powershell', 'mako',
    ];

    public function __construct(private readonly Client $client) {}

    /**
     * Presentation-ready cards, in pin order. Empty when the pins file is missing
     * or empty. Each card carries the repo's title, description, tech stack
     * (languages) and tags (topics), no vanity metrics.
     *
     * @return array<int, array{url:string,name:string,desc:string,stack:array<int,string>,tags:array<int,string>,span:string}>
     */
    public function cards(): array
    {
        $repos = $this->repositories();
        $spans = $this->spansFor(count($repos));

        return array_map(fn (array $repo, int $i) => [
            'url' => $repo['url'],
            'name' => $this->label($repo['name']),
            // The exact repo description, verbatim. GitHub already caps it, so
            // there's nothing to truncate, a mid-word cut would only be sloppy.
            'desc' => trim((string) $repo['description']),
            'stack' => $this->stack($repo['languages']),
            'tags' => $this->tags($repo),
            'span' => $spans[$i] ?? 'lg:col-span-3',
        ], $repos, array_keys($repos));
    }

    /**
     * Refresh the committed pins file from GitHub. Run locally (uses the `gh` CLI).
     * Returns the number written, or 0 when the fetch came back empty, in which case
     * the existing file is left untouched rather than clobbered with nothing.
     */
    public function refresh(): int
    {
        try {
            $repos = $this->client->pinnedRepositories();
        } catch (\Throwable $e) {
            // Rate limit, GraphQL error, or `gh` not authed: keep the committed file.
            Log::warning('GitHub pins refresh failed', ['error' => $e->getMessage()]);

            return 0;
        }

        if ($repos === []) {
            return 0;
        }

        File::put(
            $this->path(),
            json_encode($repos, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)."\n",
        );

        return count($repos);
    }

    /** Pins as recorded in the committed file. */
    private function repositories(): array
    {
        $path = $this->path();

        if (! File::exists($path)) {
            return [];
        }

        return json_decode(File::get($path), true) ?: [];
    }

    private function path(): string
    {
        return config('services.github.pins_file');
    }

    // ── presentation ──────────────────────────────────────────────────────────

    /** The real languages, biggest first, minus build/infra noise; up to three. */
    private function stack(array $languages): array
    {
        $real = array_values(array_filter(
            $languages,
            fn ($l) => ! in_array(strtolower($l), self::NON_STACK, true)
        ));

        return array_slice($real ?: $languages, 0, 3);
    }

    /** Up to three tidy tags from the repo topics. */
    private function tags(array $repo): array
    {
        return collect($repo['topics'])
            ->reject(fn ($t) => str_contains($t, 'model-context'))
            ->take(3)
            ->map(fn ($t) => $this->label($t))
            ->values()
            ->all();
    }

    /** Humanise a slug: known acronyms upper-case, every other word Title-cased. */
    private function label(string $slug): string
    {
        return collect(preg_split('/[-_\s]+/', strtolower($slug)))
            ->map(fn (string $word) => in_array($word, self::ACRONYMS, true)
                ? Str::upper($word)
                : Str::ucfirst($word))
            ->implode(' ');
    }

    /** Irregular six-column bento spans by pin count; the first cell is the flagship. */
    private function spansFor(int $n): array
    {
        return match ($n) {
            0, 1 => ['lg:col-span-6'],
            2 => ['lg:col-span-3', 'lg:col-span-3'],
            3 => ['lg:col-span-2', 'lg:col-span-2', 'lg:col-span-2'],
            4 => ['lg:col-span-4', 'lg:col-span-2', 'lg:col-span-3', 'lg:col-span-3'],
            5 => ['lg:col-span-3', 'lg:col-span-3', 'lg:col-span-2', 'lg:col-span-2', 'lg:col-span-2'],
            default => ['lg:col-span-4', 'lg:col-span-2', 'lg:col-span-3', 'lg:col-span-3', 'lg:col-span-3', 'lg:col-span-3'],
        };
    }
}
