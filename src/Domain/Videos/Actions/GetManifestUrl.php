<?php

namespace Domain\Videos\Actions;

use Domain\Videos\Models\Video;

class GetManifestUrl
{
    public function execute(Video $video, string $type): string
    {
        $route = trim(route('api.videos.manifest', compact('type', 'video'), false), '/');

        return implode('/', [$this->getVodUrl(), $route, 'manifest.mpd']);
    }

    protected function getVodUrl(): string
    {
        return implode('/', [
            config('vod.url'),
            config('vod.path'),
        ]);
    }
}
