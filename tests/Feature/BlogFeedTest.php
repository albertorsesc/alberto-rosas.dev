<?php

namespace Tests\Feature;

use Tests\TestCase;

class BlogFeedTest extends TestCase
{
    public function test_the_feed_returns_well_formed_rss(): void
    {
        $response = $this->get('/blog/feed');

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/rss+xml; charset=utf-8');
        $response->assertSee('<?xml version="1.0" encoding="UTF-8"?>', false);
        $response->assertSee('<rss version="2.0"', false);
        $response->assertSee('<channel>', false);
        $response->assertSee('<title>Alberto Rosas</title>', false);
    }

    public function test_feed_is_not_swallowed_by_the_blog_slug_catchall(): void
    {
        // /blog/feed must resolve to the named feed route, not Prezet's blog/{slug}.
        $this->assertSame(url('/blog/feed'), route('blog.feed'));
        $this->get('/blog/feed')->assertOk()->assertSee('<rss', false);
    }
}
