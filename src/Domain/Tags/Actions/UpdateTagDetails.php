<?php

namespace Domain\Tags\Actions;

use Domain\Tags\Models\Tag;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UpdateTagDetails
{
    public function execute(Tag $model, array $attributes): void
    {
        DB::transaction(function () use ($model, $attributes) {
            $model->updateOrFail(
                Arr::only($attributes, $model->getFillable())
            );

            if (array_key_exists('related', $attributes)) {
                $relates = collect(data_get($attributes['related'], '*.id', []))->toModels();

                $model->syncRelated($relates);
            }

            app(RefreshTags::class)->execute();
        });
    }
}
