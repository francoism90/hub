<?php

namespace Domain\Imports\Actions;

use Domain\Imports\Models\Import;
use Domain\Videos\Jobs\ImportVideo;

class BulkImport
{
    public function execute(): void
    {
        app(SyncImports::class)->execute();

        Import::query()
            ->pending()
            ->each(fn (Import $model) => ImportVideo::dispatch($model));
    }
}
