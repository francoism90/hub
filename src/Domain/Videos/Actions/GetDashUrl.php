<?php

namespace Domain\Videos\Actions;

use Domain\Videos\Models\Video;

class GetDashUrl
{
    public function execute(Video $video, string $type, ?bool $remote = null): string
    {
        abort_if(! $video->hasMedia('clips'), 404);

        $url = $this->getManifestUrl($remote);

        $path = str(route('videos.manifest', compact('video', 'type'), false))->trim('/');

        return implode('/', [$url, $path, 'manifest.mpd']);
    }

    protected function getManifestUrl(?bool $remote = null): string
    {
        $url = config('vod.dash.url') ?: config('vod.url');

        $prefix = true === $remote
            ? config('vod.dash.remote_path')
            : config('vod.dash.path');

        return implode('/', [$url, $prefix]);
    }
}
