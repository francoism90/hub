<?php

namespace Domain\Videos\Actions;

use Domain\Videos\Models\Video;

class GetManifestUrl
{
    public function execute(Video $video, string $type): string
    {
        abort_if(! $video->hasMedia('clips'), 404);

        $path = str(route('videos.manifest', compact('video', 'type'), false))->trim('/');

        return implode('/', [$this->getVodUrl(), $path, 'manifest.mpd']);
    }

    protected function getVodUrl(): string
    {
        return implode('/', [
            $this->getVodDashUrl(),
            $this->getVodDashPath(),
        ]);
    }

    protected function getVodDashUrl(): string
    {
        return config('vod.dash.url') ?: config('vod.url');
    }

    protected function getVodDashPath(): string
    {
        return config('vod.dash.path');
    }
}
