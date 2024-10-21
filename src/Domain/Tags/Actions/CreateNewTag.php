<?php

declare(strict_types=1);

namespace Domain\Tags\Actions;

use Domain\Tags\Models\Tag;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CreateNewTag
{
    public function execute(array $attributes): Tag
    {
        return DB::transaction(function () use ($attributes) {
            $model = Tag::firstOrCreate(
                Arr::only($attributes, ['name', 'type']),
                Arr::only($attributes, app(Tag::class)->getFillable()),
            );

            return $model;
        });
    }
}
