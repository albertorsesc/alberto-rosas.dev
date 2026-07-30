<?php

namespace Tests\Feature;

use App\Services\Github\Pins;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GithubPinsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
        // Force the API path (not the local `gh` fallback) by giving a token.
        config()->set('services.github.token', 'test-token');
        config()->set('services.github.user', 'albertorsesc');
        config()->set('services.github.pins_ttl_hours', 168);
    }

    private function fakePins(array $nodes): void
    {
        Http::fake([
            'api.github.com/graphql' => Http::response([
                'data' => ['user' => ['pinnedItems' => ['nodes' => $nodes]]],
            ]),
        ]);
    }

    private function repoNode(array $overrides = []): array
    {
        return array_merge([
            'name' => 'kvault-mcp',
            'description' => 'A plugin-first MCP server for operating on knowledge vaults.',
            'url' => 'https://github.com/albertorsesc/kvault-mcp',
            'stargazerCount' => 0,
            'primaryLanguage' => ['name' => 'Python'],
            'languages' => ['nodes' => [['name' => 'Python'], ['name' => 'Dockerfile']]],
            'repositoryTopics' => ['nodes' => [['topic' => ['name' => 'mcp']]]],
        ], $overrides);
    }

    public function test_homepage_experiments_mirror_the_pinned_repositories(): void
    {
        $this->fakePins([
            $this->repoNode(),
            $this->repoNode([
                'name' => 'job-seeker',
                'description' => 'Profile-driven job search engine over MCP and CLI.',
                'url' => 'https://github.com/albertorsesc/job-seeker',
                'primaryLanguage' => ['name' => 'Python'],
                'languages' => ['nodes' => [['name' => 'Python']]],
                'repositoryTopics' => ['nodes' => [
                    ['topic' => ['name' => 'agents']],
                    ['topic' => ['name' => 'cli']],
                ]],
            ]),
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        // Title: humanised, acronyms upper-cased natively.
        $response->assertSee('Kvault MCP');
        $response->assertSee('Job Seeker');
        // Tech stack rendered.
        $response->assertSee('Python');
        // Tags from topics, acronyms upper-cased.
        $response->assertSee('CLI');
        // Real pin URLs.
        $response->assertSee('https://github.com/albertorsesc/kvault-mcp');
    }

    public function test_experiments_section_hides_when_no_pins(): void
    {
        $this->fakePins([]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertDontSee('// experiments', false);
    }

    public function test_service_serves_stale_cache_when_a_refresh_fails(): void
    {
        // Prime the cache with one good fetch.
        $this->fakePins([$this->repoNode()]);
        $pins = app(Pins::class);
        $this->assertNotEmpty($pins->cards());

        // Expire freshness, then make GitHub fail: last good data must survive.
        Cache::forget('github.pins.v1.fresh');
        Http::fake(['api.github.com/graphql' => Http::response('boom', 500)]);

        $cards = app(Pins::class)->cards();
        $this->assertNotEmpty($cards);
        $this->assertSame('Kvault MCP', $cards[0]['name']);
    }

    public function test_refresh_command_populates_the_cache(): void
    {
        $this->fakePins([$this->repoNode()]);

        $this->artisan('github:pins:refresh')
            ->expectsOutputToContain('Refreshed 1 pinned repositories.')
            ->assertSuccessful();
    }
}
