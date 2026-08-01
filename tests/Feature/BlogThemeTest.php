<?php

namespace Tests\Feature;

use Tests\TestCase;

class BlogThemeTest extends TestCase
{
    public function test_blog_pages_resolve_the_saved_theme_before_paint(): void
    {
        // The render-blocking resolver (unique `=== 'false'` check) must be present
        // so a light-mode reader never sees the server's default dark render flash.
        $this->get('/blog')
            ->assertOk()
            ->assertSee("getItem('darkMode') === 'false'", false);
    }

    public function test_dark_only_pages_omit_the_theme_resolver(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertDontSee("getItem('darkMode') === 'false'", false);
    }
}
