<?php

declare(strict_types=1);

namespace Domain\Imports\Actions;

use Domain\Imports\Models\Import;
use Illuminate\Support\Facades\DB;

class MarkImportAsProcessed
{
    public function execute(Import $import): mixed
    {
        return DB::transaction(function () use ($import) {
            $import->updateOrFail(['finished_at' => now()]);

            return $import;
        });
    }
}
