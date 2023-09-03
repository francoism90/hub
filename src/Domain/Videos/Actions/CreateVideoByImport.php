<?php

namespace Domain\Videos\Actions;

use Domain\Imports\Actions\MarkAsFinished;
use Domain\Imports\Models\Import;
use Domain\Videos\Models\Video;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CreateVideoByImport
{
    public function execute(Import $import): void
    {
        throw_if(! Storage::disk('import')->exists($import->path));

        DB::transaction(function () use ($import) {
            $model = Video::create(
                Arr::only($import->toArray(), ['name', 'user_id'])
            );

            $model
                ->addMediaFromDisk($import->file_name, 'import')
                ->toMediaCollection('clips');

            app(MarkAsFinished::class)->execute($import);

            app(RegenerateVideo::class)->execute($model);
        });
    }
}
