<?php

declare(strict_types=1);

namespace Domain\Imports\Actions;

use Domain\Imports\Models\Import;
use Domain\Imports\States\Pending;
use Illuminate\Support\Arr;

class CreateImport
{
    public function execute(array $attributes): Import
    {
        $attributes['state'] = Pending::class;

        return Import::updateOrCreate(
            Arr::only($attributes, ['file_name', 'state']),
            Arr::only($attributes, app(Import::class)->getFillable())
        );
    }
}
