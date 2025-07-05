<?php

declare(strict_types=1);

namespace Domain\Transcodes\Actions;

use Closure;
use Domain\Transcodes\DataObjects\PipelineData;
use Domain\Transcodes\Models\Transcode;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;

class CreateVideoTranscode
{
    public function __invoke(Video $video, array $attributes, Closure $next): mixed
    {
        return DB::transaction(function () use ($video, $attributes, $next) {
            // Ensure the video has clips
            if (! $video->hasMedia('clips')) {
                return $next($video, null);
            }

            // Model attributes
            $attributes['model_type'] = $video->getMorphClass();
            $attributes['model_id'] = $video->getKey();

            // Pipeline attribute
            $attributes['pipeline'] = $this->getPipelineData($video);

            // Create Model
            $model = Transcode::create($attributes);

            return $next($model, $video);
        });
    }

    protected function getPipelineData(Video $video): PipelineData
    {
        $clip = $video->getMedia('clips')->first();

        return PipelineData::from([
            'disk' => $clip->disk,
            'path' => $clip->getPathRelativeToRoot(),
            'name' => Str::slug($video->getRouteKey(), '-'),
        ]);
    }

    protected function getClipCollection(Video $video): MediaCollection
    {
        return $video->getMedia('clips')->sortBy([
            ['custom_properties->bitrate', 'desc'],
            ['custom_properties->width', 'desc'],
            ['custom_properties->height', 'desc'],
        ]);
    }
}
