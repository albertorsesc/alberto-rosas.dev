<?php

namespace App\Services\Github;

use Illuminate\Support\Facades\Http;

/**
 * Talks to GitHub. GitHub exposes pinned repositories only through the GraphQL
 * API (never REST), and every GraphQL call must be authenticated — a token of
 * any scope, even none, is enough to read public pins. In local dev where no
 * token is set, we fall back to the keyring-authed `gh` CLI so it just works.
 */
class Client
{
    public function __construct(
        private readonly ?string $token,
        private readonly string $user,
    ) {}

    /**
     * The profile's pinned repositories, normalised with their specs.
     *
     * @return array<int, array{name:string,description:string,url:string,languages:array<int,string>,topics:array<int,string>}>
     */
    public function pinnedRepositories(): array
    {
        $nodes = $this->token ? $this->fetchViaApi() : $this->fetchViaCli();

        return $this->normalize($nodes);
    }

    private function fetchViaApi(): array
    {
        $response = Http::withToken($this->token)
            ->acceptJson()
            ->timeout(6)
            ->post('https://api.github.com/graphql', ['query' => $this->query()]);

        $response->throw();

        // GraphQL signals rate limits and query failures with an `errors` body at
        // HTTP 200, which $response->throw() doesn't catch. Treat it as a failure so
        // the caller's stale-tolerant path serves the last good pins instead of
        // caching an empty result as fresh.
        if (! empty($response->json('errors'))) {
            throw new \RuntimeException('GitHub GraphQL returned errors: '.json_encode($response->json('errors')));
        }

        return $response->json('data.user.pinnedItems.nodes') ?? [];
    }

    /** Local-dev fallback via the `gh` CLI. Never reached in production. */
    private function fetchViaCli(): array
    {
        if (! function_exists('shell_exec')) {
            return [];
        }

        // escapeshellarg single-quotes the whole query, so $(...)/backticks in it
        // (e.g. via a hostile GITHUB_USER) are inert rather than shell-evaluated.
        $out = @shell_exec('gh api graphql -f query='.escapeshellarg($this->query()).' 2>/dev/null');

        return $out ? (json_decode($out, true)['data']['user']['pinnedItems']['nodes'] ?? []) : [];
    }

    private function normalize(array $nodes): array
    {
        return array_values(array_filter(array_map(function ($node) {
            if (empty($node['name'])) {
                return null;
            }

            return [
                'name' => $node['name'],
                'description' => $node['description'] ?? '',
                'url' => $node['url'] ?? "https://github.com/{$this->user}/{$node['name']}",
                // Tech stack: real languages, biggest first, with GitHub's own
                // primary language guaranteed to lead even if it isn't the largest.
                'languages' => array_values(array_unique(array_filter([
                    $node['primaryLanguage']['name'] ?? null,
                    ...array_map(fn ($l) => $l['name'], $node['languages']['nodes'] ?? []),
                ]))),
                'topics' => array_map(
                    fn ($t) => strtolower($t['topic']['name']),
                    $node['repositoryTopics']['nodes'] ?? []
                ),
            ];
        }, $nodes)));
    }

    private function query(): string
    {
        return 'query { user(login: "'.$this->user.'") { pinnedItems(first: 6, types: REPOSITORY) { '
            .'nodes { ... on Repository { name description url primaryLanguage { name } '
            .'languages(first: 5, orderBy: {field: SIZE, direction: DESC}) { nodes { name } } '
            .'repositoryTopics(first: 8) { nodes { topic { name } } } } } } } }';
    }
}
