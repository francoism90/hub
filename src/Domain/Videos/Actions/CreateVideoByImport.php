<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Closure;
use Domain\Imports\Actions\MarkImportAsFinished;
use Domain\Imports\Models\Import;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\DB;

class CreateVideoByImport
{
    public function __invoke(Import $import, Closure $next): mixed
    {
        return DB::transaction(function () use ($import, $next) {
            /** @var Video $video */
            $video = Video::create([
                'name' => $import->name ?: $import->file_name,
                'user_id' => $import->user_id,
            ]);

            $video
                ->addMediaFromDisk($import->file_name, 'import')
                ->toMediaCollection('clips');

            app(MarkImportAsFinished::class)->handle($import);

            return $next($import, $video);
        });
    }
}
