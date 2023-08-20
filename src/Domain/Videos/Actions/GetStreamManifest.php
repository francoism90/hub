<?php

namespace Domain\Videos\Actions;

use Domain\Media\Models\Media;
use Domain\Videos\Models\Video;
use Domain\Videos\Support\Vod\Clip;
use Domain\Videos\Support\Vod\Manifest;
use Domain\Videos\Support\Vod\Sequence;
use Illuminate\Support\Collection;

class GetStreamManifest
{
    public function execute(Video $model): array
    {
        abort_if(! $model->hasMedia('clips'), 404);

        $sequences = array_merge(
            $this->getClips($model)->toArray(),
            $this->getCaptions($model)->toArray(),
        );

        return (new Manifest)
            ->id($model->getRouteKey())
            ->sequences($sequences)
            ->toArray();
    }

    protected function getClips(Video $model): Collection
    {
        return $model->clips()->map(fn (Media $media) => (new Sequence)
            ->id($media->getRouteKey())
            ->label($media->getRouteKey())
            ->clips([
                (new Clip)->type('source')->path($media->getPath()),
            ])
        );
    }

    protected function getCaptions(Video $model): Collection
    {
        return $model->captions()->map(fn (Media $media) => (new Sequence)
            ->id($media->getRouteKey())
            ->label($media->getRouteKey())
            ->language($media->getCustomProperty('locale', 'eng'))
            ->clips([
                (new Clip)->type('source')->path($media->getPath()),
            ])
        );
    }
}
