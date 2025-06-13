<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Domain\Videos\Models\Video;
use Illuminate\Support\Uri;

class GetVideoManifestUrl
{
    public function execute(Video $video, string $type, bool $live = false, ?string $format = null): Uri
    {
        abort_if(! $video->hasMedia('clips'), 404);

        $baseUrl = $live ? config('vod.live_url') : config('vod.url');

        $format ??= config('vod.format', 'dash');

        $parameters = fluent(match ($format) {
            'dash' => config('vod.dash'),
            default => config('vod.hls'),
        });

        $relativePath = trim(route('api.videos.manifest', compact('video', 'type'), false), '/');

        $path = implode('/', [$parameters->path, $relativePath, $parameters->name]);

        return Uri::of($baseUrl)
            ->withPath($path)
            ->withQuery($parameters->query ?? [])
            ->withFragment($parameters->fragment ?? '');
    }
}
