<?php

namespace Domain\Imports\Actions;

use Domain\Imports\Models\Import;
use Domain\Videos\Actions\CreateVideoByImport;

class BulkImport
{
    public function execute(): void
    {
        app(SyncImports::class)->execute();

        Import::query()
            ->pending()
            ->each(fn (Import $model) => app(CreateVideoByImport::class)->execute($model));
    }
}
