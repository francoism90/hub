<?php

namespace Domain\Videos\Actions;

use Domain\Videos\Models\Video;

class GetManifestUrl
{
    public function execute(Video $video, string $type): string
    {
        $route = trim(route('api.videos.manifest', compact('type', 'video'), false), '/');

        return implode('/', [
            config('settings.vod_url'), config('settings.vod_path'), $route, 'manifest.mpd',
        ]);
    }
}
