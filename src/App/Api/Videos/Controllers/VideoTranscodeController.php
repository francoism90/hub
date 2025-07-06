<?php

declare(strict_types=1);

namespace App\Api\Videos\Controllers;

use Domain\Videos\Exceptions\NoTranscodingFound;
use Domain\Videos\Models\Video;
use Foundation\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\StreamedResponse;

class VideoTranscodeController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum'),
            new Middleware('cache:public;max_age=604800;immutable;etag'),
        ];
    }

    public function __invoke(Video $video, string $path): StreamedResponse
    {
        Gate::authorize('view', $video);

        // Check if the video has been transcoded
        $transcode = $video->currentTranscode();

        throw_if(! $transcode, NoTranscodingFound::make());

        // Prevent directory traversal
        $path = str($path)->replace(['../', './'], '')->value();

        return $transcode->getFilesystem()->response("{$transcode->getPath()}/{$path}");
    }
}
