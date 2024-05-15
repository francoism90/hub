<?php

namespace Domain\Tags\Actions;

use ArrayAccess;
use Domain\Tags\Models\Tag;
use Illuminate\Database\Eloquent\Model;

class SyncModelTags
{
    public function execute(Model $model, array|ArrayAccess $items = []): void
    {
        $ids = data_get($items, '*.id', []);

        $models = Tag::query()
            ->whereIn('prefixed_id', $ids)
            ->get();

        $model->tags()->sync($models);
    }
}
