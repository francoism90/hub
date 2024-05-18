<?php

namespace Domain\Tags\Actions;

use Domain\Tags\Models\Tag;
use Illuminate\Support\Arr;

class UpdateTagDetails
{
    public function execute(Tag $model, array $attributes): void
    {
        $model->updateOrFail(
            Arr::only($attributes, $model->getFillable())
        );
    }
}
