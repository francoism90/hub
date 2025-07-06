<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Domain\Transcodes\Actions\GenerateHlsTranscode;
use Domain\Transcodes\Actions\MarkTranscodeAsFinished;
use Domain\Transcodes\DataObjects\PipelineData;
use Domain\Videos\Events\VideoHasBeenTranscoded;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Pipeline;

class CreateVideoManifest
{
    public function handle(Video $video, array $attributes = []): mixed
    {
        return DB::transaction(function () use ($video, $attributes) {
            // Get the first clip from the video
            $media = $video->getClipCollection()->first();

            // Create transcode model
            $attributes['pipeline'] = PipelineData::from([
                'name' => 'manifest.m3u8',
                'disk' => $media->disk,
                'path' => $media->getPathRelativeToRoot(),
                'destination' => config('transcode.disk_name', 'transcode'),
                'segmentLength' => config('transcode.segment_length', 10),
                'frameInterval' => config('transcode.frame_interval', 48),
                'formats' => config('transcode.formats', []),
            ]);

            $transcode = $video->transcodes()->create($attributes);

            // Perform the transcode
            Pipeline::send($transcode)
                ->through([
                    GenerateHlsTranscode::class,
                    MarkTranscodeAsFinished::class,
                ])
                ->thenReturn();

            // Fire event that the video has been transcoded
            VideoHasBeenTranscoded::dispatch($video);
        });
    }
}
