<?php

declare(strict_types=1);

namespace App\Api\Transcodes\Controllers;

use Domain\Transcodes\Exceptions\ExpiredTranscodeException;
use Domain\Transcodes\Models\Transcode;
use Foundation\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use League\Flysystem\WhitespacePathNormalizer;
use ProtoneMedia\LaravelFFMpeg\Http\DynamicHLSPlaylist;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class TranscodePlaylistController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum'),
            // new Middleware('cache_response:90'),
        ];
    }

    public function __invoke(Transcode $transcode, string $path): DynamicHLSPlaylist
    {
        Gate::authorize('view', [$transcode->getModel(), $transcode]);

        throw_if($transcode->isExpired(), ExpiredTranscodeException::make());

        // Sanitize the path to prevent directory traversal attacks
        $path = (new WhitespacePathNormalizer())->normalizePath($path);

        return FFMpeg::dynamicHLSPlaylist()
            ->fromDisk($transcode->getDisk())
            ->open("{$transcode->getPath()}/{$path}")
            ->setPlaylistUrlResolver(fn (string $path) => route('api.transcodes.playlist', ['transcode' => $transcode, 'path' => $path]))
            ->setMediaUrlResolver(fn (string $path) => route('api.transcodes.media', ['transcode' => $transcode, 'path' => $path]));
    }
}
