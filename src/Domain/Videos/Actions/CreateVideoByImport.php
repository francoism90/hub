<?php

namespace Domain\Videos\Actions;

use Domain\Imports\Models\Import;
use Domain\Videos\Jobs\OptimizeVideo;
use Domain\Videos\Jobs\ProcessVideo;
use Domain\Videos\Jobs\ReleaseVideo;
use Domain\Videos\Models\Video;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;

class CreateVideoByImport
{
    public function execute(Import $import): void
    {
        DB::transaction(function () use ($import) {
            // Create record
            $model = Video::create(
                Arr::only($import->toArray(), ['name', 'user_id'])
            );

            // Attach media
            $model
                ->addMediaFromDisk($import->file_name, 'import')
                ->toMediaCollection('clips');

            // Process model
            Bus::chain([
                new ProcessVideo($model),
                new OptimizeVideo($model),
                new ReleaseVideo($model),
            ])->dispatch();
        });
    }
}
