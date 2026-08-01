<?php

namespace Tests\Feature;

use Prezet\Prezet\Models\Document;
use Tests\TestCase;

class HomepageWritingTest extends TestCase
{
    public function test_homepage_links_the_latest_posts(): void
    {
        $latest = Document::where('draft', false)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $this->assertNotEmpty($latest, 'Prezet index has no published posts');

        $response = $this->get('/');

        $response->assertStatus(200);
        foreach ($latest as $doc) {
            $response->assertSee($doc->frontmatter->title);
            $response->assertSee(route('prezet.show', $doc->slug));
        }
        $response->assertSee(route('prezet.index'));
    }
}
