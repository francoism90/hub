<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Domain\Videos\Models\Video;

class GetDashUrl
{
    public function execute(Video $video, string $type, ?bool $live = false): string
    {
        abort_if(! $video->hasMedia('clips'), 404);

        $url = $this->getManifestUrl($live);

        $path = str(route('api.videos.manifest', compact('video', 'type'), false))->trim('/');

        return implode('/', [$url, $path, 'manifest.mpd']);
    }

    protected function getManifestUrl(?bool $live = false): string
    {
        $url = $live ? config('vod.live_url') : config('vod.url');

        return implode('/', [$url, config('vod.dash.path')]);
    }
}
