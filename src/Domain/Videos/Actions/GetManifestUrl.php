<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Domain\Videos\Models\Video;
use Illuminate\Support\Uri;

class GetManifestUrl
{
    public function execute(Video $video, string $format, bool $live = false): Uri
    {
        abort_if(! $video->hasMedia('clips'), 404);

        $parameters = fluent(match ($format) {
            'dash' => config('vod.dash'),
            'hls' => config('vod.hls'),
            default => abort(400, 'Invalid format'),
        });

        $baseUrl = $live ? config('vod.live_url') : config('vod.url');

        $relativePath = route('api.videos.manifest', compact('video', 'format'), false);

        $path = implode('/', [$parameters->path, $relativePath, $parameters->name]);

        logger($path);

        $uri = Uri::of($baseUrl)
            ->withPath($path)
            ->withQuery($parameters->query ?? [])
            ->withFragment($parameters->fragment ?? '');

        logger($uri);

        return $uri;
    }
}
