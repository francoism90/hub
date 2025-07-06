<?php

declare(strict_types=1);

namespace App\Api\Videos\Controllers;

use Domain\Videos\Actions\GetPreviewManifest;
use Domain\Videos\Actions\GetVideoManifest;
use Domain\Videos\Models\Video;
use Foundation\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
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
            // new Middleware('cache_model:600,video'),
        ];
    }

    public function __invoke(Video $video, string $path): DynamicHLSPlaylist
    {
        // Gate::authorize('view', $video);

        $transcode = $video->transcodes()->first();

        $pipeline = $transcode->pipeline;

        return FFMpeg::dynamicHLSPlaylist()
            ->fromDisk($pipeline->destination)
            ->open("{$transcode->getPath()}/{$path}")
            ->setMediaUrlResolver(fn (string $path) => route('api.videos.playlist', ['video' => $video, 'path' => $path]))
            ->setPlaylistUrlResolver(fn (string $path) => route('api.videos.manifest', ['video' => $video, 'path' => $path]));
    }
}
