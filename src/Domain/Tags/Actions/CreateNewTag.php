<?php

namespace Domain\Tags\Actions;

use Domain\Tags\Models\Tag;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CreateNewTag
{
    public function execute(array $attributes): void
    {
        DB::transaction(function () use ($attributes) {
            Tag::firstOrCreate(
                Arr::only($attributes, ['name', 'type']),
                Arr::only($attributes, app(Tag::class)->getFillable()),
            );

            app(RefreshTags::class)->execute();
        });
    }
}
