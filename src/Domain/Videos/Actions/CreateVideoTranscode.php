<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Domain\Transcodes\Actions\GenerateHlsTranscode;
use Domain\Transcodes\DataObjects\PipelineData;
use Domain\Videos\Events\VideoHasBeenTranscoded;
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
                'name' => 'manifest.m3u8',
                'disk' => $clip->disk,
                'path' => $clip->getPathRelativeToRoot(),
                'destination' => (string) config('transcode.disk', 'transcode'),
                'segmentLength' => (int) config('transcode.segment_length', 10),
                'frameInterval' => (int) config('transcode.frame_interval', 48),
                'formats' => config('transcode.formats', []),
            ]);

            $transcode = $video->transcodes()->create($attributes);

            // Perform the transcode
            app(GenerateHlsTranscode::class)->handle($transcode);

            // Dispatch the event after the transcode is created
            event(new VideoHasBeenTranscoded($video));
        });
    }
}
