<?php

namespace App\Services\Github;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Turns the pinned repositories into cards for the homepage "experiments" grid.
 *
 * The homepage mirrors whatever is pinned on GitHub: re-pin there and the site
 * follows on the next refresh, no code change. GitHub has no API to *set* pins,
 * so re-pinning stays a browser action; everything after it is automatic.
 *
 * Caching is stale-tolerant: a GitHub outage serves the last good result instead
 * of blanking the section, and a cold failure returns [] so the section hides.
 */
class Pins
{
    private const CACHE_KEY = 'github.pins.v1';

    private const FRESH_KEY = 'github.pins.v1.fresh';

    /** Slugs rendered upper-case (MCP, CLI, …) instead of Title-cased. */
    private const ACRONYMS = ['mcp', 'cli', 'ai', 'api', 'sql', 'llm', 'rag', 'ui', 'ml'];

    /** Build/infra "languages" GitHub reports that aren't a tech stack. */
    private const NON_STACK = [
        'dockerfile', 'makefile', 'shell', 'batchfile', 'cmake',
        'roff', 'dotenv', 'procfile', 'powershell', 'mako',
    ];

    public function __construct(
        private readonly Client $client,
        private readonly int $ttlHours = 6,
    ) {}

    /**
     * Presentation-ready cards, in pin order. Empty when nothing is pinned or a
     * cold fetch fails. Each card carries the repo's title, description, tech
     * stack (languages) and tags (topics) — no vanity metrics; those live on the
     * repo page itself.
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
            // there's nothing to truncate — a mid-word cut would only be sloppy.
            'desc' => trim((string) $repo['description']),
            'stack' => $this->stack($repo['languages']),
            'tags' => $this->tags($repo),
            'span' => $spans[$i] ?? 'lg:col-span-3',
        ], $repos, array_keys($repos));
    }

    /** Force a fresh fetch into the cache. Returns the new pin count. */
    public function refresh(): int
    {
        return $this->store($this->client->pinnedRepositories());
    }

    /** Raw pins, stale-tolerant: refetch past the TTL, keep the last good on failure. */
    private function repositories(): array
    {
        $cached = Cache::get(self::CACHE_KEY);

        if (is_array($cached) && Cache::has(self::FRESH_KEY)) {
            return $cached;
        }

        try {
            $repos = $this->client->pinnedRepositories();
            $this->store($repos);

            return $repos;
        } catch (\Throwable $e) {
            Log::warning('GitHub pins fetch failed', ['error' => $e->getMessage()]);

            return is_array($cached) ? $cached : [];
        }
    }

    private function store(array $repos): int
    {
        Cache::forever(self::CACHE_KEY, $repos);
        Cache::put(self::FRESH_KEY, true, now()->addHours($this->ttlHours));

        return count($repos);
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
