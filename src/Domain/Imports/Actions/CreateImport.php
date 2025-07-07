<?php

declare(strict_types=1);

namespace Domain\Imports\Actions;

use Domain\Imports\Models\Import;
use Illuminate\Support\Arr;

class CreateImport
{
    public function execute(array $attributes): Import
    {
        return Import::updateOrCreate(
            Arr::only($attributes, ['file_name']),
            Arr::only($attributes, app(Import::class)->getFillable())
        );
    }
}
