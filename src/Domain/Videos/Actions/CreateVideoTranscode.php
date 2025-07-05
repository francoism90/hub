<?php

declare(strict_types=1);

namespace Domain\Transcodes\Actions;

use Domain\Transcodes\DataObjects\PipelineData;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\DB;

class CreateVideoTranscode
{
    public function handle(Video $video, array $attributes = []): mixed
    {
        return DB::transaction(function () use ($video, $attributes) {
            // Get the first clip from the video
            $clip = $video->getClipCollection()->first();

            // Create transcode model
            $attributes['pipeline'] = PipelineData::from([
                'disk' => $clip->disk,
                'path' => $clip->getPathRelativeToRoot(),
            ]);

            $transcode = $video->transcodes()->create($attributes);

            // Perform the transcode
            app(GenerateHlsTranscode::class)->handle($transcode);
        });
    }
}
