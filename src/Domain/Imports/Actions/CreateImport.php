<?php

namespace Domain\Imports\Actions;

use Domain\Imports\Models\Import;
use Illuminate\Support\Arr;

class CreateImport
{
    public function execute(array $attributes): Import
    {
        $model = Import::query()
            ->pending()
            ->where('file_name', $attributes['file_name'])
            ->first();

        if ($model) {
            $model->updateOrFail(
                Arr::only($attributes, ['name', 'size', 'type', 'mime_type'])
            );

            return $model;
        }

        return Import::create(
            Arr::only($attributes, app(Import::class)->getFillable())
        );
    }
}
