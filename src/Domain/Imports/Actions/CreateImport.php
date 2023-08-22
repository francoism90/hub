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
            return $model;
        }

        return Import::create(
            Arr::only($attributes, app(Import::class)->getFillable())
        );
    }
}
