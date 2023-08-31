<?php

namespace Domain\Videos\Actions;

use Domain\Videos\Jobs\OptimizeVideo;
use Domain\Videos\Models\Video;
use Illuminate\Support\Arr;

class UpdateVideoDetails
{
    public function execute(Video $model, array $attributes): void
    {
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
