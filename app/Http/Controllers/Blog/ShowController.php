<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Prezet\Prezet\Actions\GetDocumentModelFromSlug;
use Prezet\Prezet\Actions\GetHeadings;
use Prezet\Prezet\Actions\GetMarkdown;
use Prezet\Prezet\Actions\ParseMarkdown;

/**
 * Blog post. Resolves the document by slug (404s on miss / drafts in prod),
 * renders its markdown to HTML via the engine's actions, and extracts the TOC.
 */
class ShowController extends Controller
{
    public function __invoke(
        string $slug,
        GetDocumentModelFromSlug $getDocument,
        GetMarkdown $getMarkdown,
        ParseMarkdown $parseMarkdown,
        GetHeadings $getHeadings,
    ) {
        $document = $getDocument->handle($slug);
        $html = $parseMarkdown->handle($getMarkdown->handle($document->filepath))->getContent();

        return view('prezet::show', [
            'frontmatter' => $document->frontmatter,
            'body' => $html,
            'headings' => $getHeadings->handle($html),
        ]);
    }
}
