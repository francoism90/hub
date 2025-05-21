<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Closure;
use Domain\Imports\Actions\MarkAsFinished;
use Domain\Imports\Models\Import;
use Domain\Videos\Models\Video;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CreateVideoByImport
{
    public function __invoke(Import $model, Closure $next): mixed
    {
        return DB::transaction(function () use ($model, $next) {
            $video = Video::create(
                Arr::only($model->toArray(), ['name', 'user_id'])
            );

            $video
                ->addMediaFromDisk($model->file_name, 'import')
                ->toMediaCollection('clips');

            app(MarkAsFinished::class)($model);
            app(RegenerateVideo::class)($video);

            return $next($video);
        });
    }
}
