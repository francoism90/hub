<?php

declare(strict_types=1);

namespace Domain\Transcodes\Actions;

use Closure;
use Domain\Transcodes\DataObjects\PipelineData;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\DB;

class CreateVideoTranscode
{
    public function __invoke(Video $video, array $attributes, Closure $next): mixed
    {
        return DB::transaction(function () use ($video, $attributes, $next) {
            $clips = $video->getClipCollection();

            if ($clips->isEmpty() || $video->transcodes()->exists()) {
                return $next($video, null);
            }

            // Ensure first clip is used for transcode
            $clip = $video->getClipCollection()->first();

            // Pipeline attribute
            $attributes['pipeline'] = PipelineData::from([
                'disk' => $clip->disk,
                'path' => $clip->getPathRelativeToRoot(),
            ]);

            // Create Model
            $model = $video->transcodes()->create($attributes);

            return $next($model, $video);
        });
    }
}
