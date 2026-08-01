<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Prezet\Prezet\Actions\GetImage;

/**
 * Serves blog images (optionally resized via a size suffix in the path) from the
 * prezet disk. The engine's indexer rewrites markdown image links to this route.
 */
class ImageController extends Controller
{
    public function __invoke(string $path, GetImage $getImage)
    {
        $mime = match (strtolower(pathinfo($path, PATHINFO_EXTENSION))) {
            'png' => 'image/png',
            'webp' => 'image/webp',
            default => 'image/jpeg',
        };

        return response($getImage->handle($path))->header('Content-Type', $mime);
    }
}
