<?php

declare(strict_types=1);

namespace App\Api\Videos\Controllers;

use Domain\Transcodes\Models\Transcode;
use Domain\Videos\Actions\GetPreviewManifest;
use Domain\Videos\Actions\GetVideoManifest;
use Domain\Videos\Models\Video;
use Foundation\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PlaylistController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // new Middleware('cache_model:600,video'),
        ];
    }

    public function __invoke(Video $video, string $path): StreamedResponse
    {
        // Gate::authorize('view', $video);

        $transcode = $video->transcodes()->first();

        $pipeline = $transcode->pipeline;

        return Storage::disk($pipeline->destination)->response("{$transcode->getPath()}/{$path}");
    }
}
