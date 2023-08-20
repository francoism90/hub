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
        // Sync tags
        if (array_key_exists('tags', $attributes)) {
            app(SyncModelTags::class)->execute($model, $attributes['tags'] ?: []);
        }

        // Update model attributes
        $model->updateOrFail(
            Arr::only($attributes, $model->getFillable())
        );

        // Optimize model
        OptimizeVideo::dispatchIf(
            $model->wasChanged('snapshot'), $model
        );
    }
}
