<?php

namespace Domain\Videos\Actions;

use Domain\Imports\Models\Import;
use Domain\Imports\States\Finished;
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
            $model = Video::create(
                Arr::only($import->toArray(), ['name', 'user_id'])
            );

            $model
                ->addMediaFromDisk($import->file_name, 'import')
                ->toMediaCollection('clips');

            if ($import->state->canTransitionTo(Finished::class)) {
                $import->state->transitionTo(Finished::class);
            }

            Bus::chain([
                new ProcessVideo($model),
                new OptimizeVideo($model),
                new ReleaseVideo($model),
            ])->dispatch();
        });
    }
}
