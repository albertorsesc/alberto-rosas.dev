<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GithubPinsTest extends TestCase
{
    private string $pinsFile;

    protected function setUp(): void
    {
        parent::setUp();
        // Point the pins at a throwaway file so tests never touch the committed one.
        $this->pinsFile = tempnam(sys_get_temp_dir(), 'pins');
        config()->set('services.github.pins_file', $this->pinsFile);
        // Token present so the refresh command uses the API path (Http-fakeable),
        // not the local `gh` CLI.
        config()->set('services.github.token', 'test-token');
        config()->set('services.github.user', 'albertorsesc');
    }

    protected function tearDown(): void
    {
        @unlink($this->pinsFile);
        parent::tearDown();
    }

    private function writePins(array $repos): void
    {
        file_put_contents($this->pinsFile, json_encode($repos));
    }

    /** A normalized repo, in the shape the client writes to the file. */
    private function repo(array $overrides = []): array
    {
        return array_merge([
            'name' => 'kvault-mcp',
            'description' => 'A plugin-first MCP server for operating on knowledge vaults.',
            'url' => 'https://github.com/albertorsesc/kvault-mcp',
            'languages' => ['Python', 'Dockerfile'],
            'topics' => ['mcp'],
        ], $overrides);
    }

    /** A raw GraphQL node, in the shape the API returns before normalization. */
    private function apiNode(): array
    {
        return [
            'name' => 'kvault-mcp',
            'description' => 'desc',
            'url' => 'https://github.com/albertorsesc/kvault-mcp',
            'primaryLanguage' => ['name' => 'Python'],
            'languages' => ['nodes' => [['name' => 'Python']]],
            'repositoryTopics' => ['nodes' => [['topic' => ['name' => 'mcp']]]],
        ];
    }

    public function test_homepage_experiments_mirror_the_committed_pins_file(): void
    {
        $this->writePins([
            $this->repo(),
            $this->repo([
                'name' => 'job-seeker',
                'url' => 'https://github.com/albertorsesc/job-seeker',
                'languages' => ['Python'],
                'topics' => ['agents', 'cli'],
            ]),
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Kvault MCP');   // humanised, acronym upper-cased
        $response->assertSee('Job Seeker');
        $response->assertSee('Python');       // tech stack
        $response->assertSee('CLI');          // tag from topics
        $response->assertSee('https://github.com/albertorsesc/kvault-mcp');
    }

    public function test_experiments_section_hides_when_the_pins_file_is_missing(): void
    {
        @unlink($this->pinsFile);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertDontSee('// experiments', false);
    }

    public function test_no_github_call_is_made_at_request_time(): void
    {
        Http::fake();
        $this->writePins([$this->repo()]);

        $this->get('/')->assertStatus(200);

        Http::assertNothingSent();
    }

    public function test_refresh_writes_the_pins_file_from_github(): void
    {
        @unlink($this->pinsFile);
        Http::fake(['api.github.com/graphql' => Http::response([
            'data' => ['user' => ['pinnedItems' => ['nodes' => [$this->apiNode()]]]],
        ])]);

        $this->artisan('github:pins:refresh')
            ->expectsOutputToContain('Refreshed 1 pinned repositories.')
            ->assertSuccessful();

        $this->assertFileExists($this->pinsFile);
        $written = json_decode(file_get_contents($this->pinsFile), true);
        $this->assertSame('kvault-mcp', $written[0]['name']);
    }

    public function test_refresh_does_not_clobber_the_file_on_a_graphql_error(): void
    {
        $this->writePins([$this->repo()]);

        // Rate-limit shape: HTTP 200 with an errors body → the client throws →
        // refresh keeps the committed file rather than blanking it.
        Http::fake(['api.github.com/graphql' => Http::response([
            'data' => ['user' => null],
            'errors' => [['type' => 'RATE_LIMITED', 'message' => 'API rate limit exceeded']],
        ], 200)]);

        $this->artisan('github:pins:refresh')
            ->expectsOutputToContain('kept the existing file')
            ->assertSuccessful();

        $kept = json_decode(file_get_contents($this->pinsFile), true);
        $this->assertSame('kvault-mcp', $kept[0]['name']);
    }
}
