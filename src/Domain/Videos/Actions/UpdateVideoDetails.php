<?php

namespace Domain\Videos\Actions;

use Domain\Tags\Actions\SyncModelTags;
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
            app(SyncModelTags::class)->execute($model, $attributes['tags']);
        }

        OptimizeVideo::dispatchIf(
            $model->wasChanged('snapshot'), $model
        );
    }
}
