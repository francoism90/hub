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

class PlaylistController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // new Middleware('cache_model:600,video'),
        ];
    }

    public function __invoke(Video $model, Transcode $transcode, string $path)
    {
        Gate::authorize('view', $model);

        $pipeline = $transcode->pipeline;

        return Storage::disk($pipeline->destination)->response("{$transcode->getPath()}/{$path}");
    }
}
