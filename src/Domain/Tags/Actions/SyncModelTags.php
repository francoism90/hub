<?php

namespace Domain\Tags\Actions;

use ArrayAccess;
use Domain\Tags\Collections\TagCollection;
use Illuminate\Database\Eloquent\Model;

class SyncModelTags
{
    public function execute(Model $model, array|ArrayAccess $items = []): void
    {
        $models = TagCollection::make($items)->toModels();

        $model->tags()->sync(
            $models->pluck('id')->all()
        );
    }
}
