<?php

namespace Tests\Feature;

use Tests\TestCase;

class HeaderNavTest extends TestCase
{
    public function test_blog_nav_is_current_on_an_article_page(): void
    {
        // Pull a real published article link off the index (skip feed/img/ogimage).
        $index = $this->get('/blog');
        $index->assertOk();
        preg_match_all('#href="[^"]*?(/blog/(?!feed|img/|ogimage/)[^"?\#]+)"#', $index->getContent(), $m);
        $slug = $m[1][0] ?? null;
        $this->assertNotNull($slug, 'no published article link found on /blog');

        // On an article page the Blog nav link must be marked current. Before the
        // fix, request()->is('blog') matched only /blog, so no nav link was current
        // (the TOC's active heading is client-side, not server-rendered).
        $this->get($slug)
            ->assertOk()
            ->assertSee('aria-current="page"', false);
    }
}
