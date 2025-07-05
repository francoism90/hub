<?php

declare(strict_types=1);

namespace Domain\Transcodes\Actions;

use Closure;
use Domain\Transcodes\DataObjects\PipelineData;
use Domain\Transcodes\Models\Transcode;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\DB;

class CreateVideoTranscode
{
    public function __invoke(Video $video, array $attributes, Closure $next): mixed
    {
        return DB::transaction(function () use ($video, $attributes, $next) {
            // Ensure the video has clips
            $clips = $video->getClipCollection();

            if ($clips->isEmpty()) {
                return $next($video, null);
            }

            // Ensure first clip is used for transcode
            $clip = $video->getClipCollection()->first();

            // Model attributes
            $attributes['model_type'] = $video->getMorphClass();
            $attributes['model_id'] = $video->getKey();

            // Pipeline attribute
            $attributes['pipeline'] = PipelineData::from([
                'disk' => $clip->disk,
                'path' => $clip->getPathRelativeToRoot(),
                'name' => 'manifest.m3u8',
            ]);

            // Create Model
            $model = Transcode::create($attributes);

            return $next($model, $video);
        });
    }
}
