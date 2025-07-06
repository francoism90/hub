<?php

declare(strict_types=1);

namespace App\Api\Videos\Controllers;

use Domain\Videos\Exceptions\VideoException;
use Domain\Videos\Models\Video;
use Foundation\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\LaravelFFMpeg\Http\DynamicHLSPlaylist;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class ManifestController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum'),
            // new Middleware('cache_model:600,video'),
        ];
    }

    public function __invoke(Video $video, string $path): DynamicHLSPlaylist
    {
        Gate::authorize('view', $video);

        // Check if the video has been transcoded
        $transcode = $video->currentTranscode();

        throw_if(! $transcode, VideoException::emptyTranscodeCollection());

        // Prevent directory traversal
        $path = str($path)->replace(['../', './'], '')->value();

        return FFMpeg::dynamicHLSPlaylist()
            ->fromDisk($transcode->pipeline->destination)
            ->open("{$transcode->getPath()}/{$path}")
            ->setPlaylistUrlResolver(fn (string $path) => route('api.videos.manifest', ['video' => $video, 'path' => $path]))
            ->setMediaUrlResolver(fn (string $path) => route('api.videos.playlist', ['video' => $video, 'path' => $path]));
    }
}
