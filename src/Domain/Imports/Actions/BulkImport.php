<?php

namespace Domain\Imports\Actions;

use Domain\Imports\Enums\ImportType;
use Domain\Imports\Models\Import;

class BulkImport
{
    public function execute(ImportType $type): void
    {
        app(SyncImports::class)->execute($type);

        Import::query()
            ->pending()
            ->type($type)
            ->each(fn (Import $model) => app(CreateVideoByImport::class)->execute($model));
    }
}
