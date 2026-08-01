<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Prezet\Prezet\Models\Document;

/**
 * Blog index. Prezet v1 ships no controllers, so the app owns its blog routing
 * over the engine's Document model. The custom view expects `$articles` as a
 * collection of frontmatter DTOs (title/excerpt/category/image/slug).
 */
class IndexController extends Controller
{
    public function __invoke()
    {
        $articles = Document::query()
            ->where('draft', false)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(fn (Document $doc) => $doc->frontmatter);

        return view('prezet::index', ['articles' => $articles]);
    }
}
