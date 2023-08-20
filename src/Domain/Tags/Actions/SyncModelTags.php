<?php

namespace Domain\Tags\Actions;

use ArrayAccess;
use Domain\Tags\Models\Tag;
use Illuminate\Database\Eloquent\Model;

class SyncModelTags
{
    public function execute(Model $model, array|ArrayAccess $items = []): void
    {
        $models = collect($items)
            ->map(fn (array $item) => Tag::findByPrefixedIdOrFail($item['id']))
            ->unique();

        $model->tags()->sync(
            $models->pluck('id')->all()
        );
    }
}
