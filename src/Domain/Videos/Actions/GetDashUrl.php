<?php

namespace Domain\Videos\Actions;

use Domain\Videos\Models\Video;

class GetDashUrl
{
    public function execute(Video $video, string $type): string
    {
        abort_if(! $video->hasMedia('clips'), 404);

        $url = $this->getManifestUrl();

        $path = str(route('videos.manifest', compact('video', 'type'), false))->trim('/');

        return implode('/', [$url, $path, 'manifest.mpd']);
    }

    protected function getManifestUrl(): string
    {
        return implode('/', [config('vod.url'), config('vod.dash.path')]);
    }
}
