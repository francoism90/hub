<?php

namespace Domain\Videos\Actions;

use Domain\Videos\Jobs\OptimizeVideo;
use Domain\Videos\Models\Video;
use Illuminate\Support\Arr;

class UpdateVideoDetails
{
    public function execute(Video $model, array $attributes): void
    {
        $model->updateOrFail(
            Arr::only($attributes, $model->getFillable())
        );

        if (array_key_exists('tags', $attributes)) {
            $tags = collect(data_get($attributes['tags'], '*.id', []))->toModels();

            $model->syncTags($tags);
        }

        OptimizeVideo::dispatchIf(
            $model->wasChanged('snapshot'),
            $model
        );
    }
}
