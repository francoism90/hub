<?php

namespace Domain\Videos\Actions;

use Domain\Media\Models\Media;
use Domain\Videos\Models\Video;
use Domain\Videos\Support\Vod\Clip;
use Domain\Videos\Support\Vod\Manifest;
use Domain\Videos\Support\Vod\Sequence;
use Illuminate\Support\Collection;

class GetPreviewManifest
{
    public function execute(Video $model): array
    {
        abort_if(! $model->hasMedia('previews'), 404);

        $sequences = array_merge(
            $this->getClips($model)->toArray(),
        );

        return (new Manifest)
            ->id($model->getRouteKey())
            ->sequences($sequences)
            ->toArray();
    }

    protected function getClips(Video $model): Collection
    {
        return $model->previews->map(fn (Media $media) => (new Sequence)
            ->id($media->getRouteKey())
            ->label($media->getRouteKey())
            ->clips([
                (new Clip)->type('source')->path($this->getClipUrl($media)),
                // (new Clip)
                //     ->type('source')
                //     ->path("/http/commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4"),
            ])
        );
    }

    protected function getClipUrl(Media $media): string
    {
        return str($media->getFullUrl())
            ->replaceFirst('://', '/')
            ->prepend('/');
    }
}
