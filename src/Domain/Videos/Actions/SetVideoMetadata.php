<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Closure;
use Domain\Media\Models\Media;
use Domain\Videos\Models\Video;
use FFMpeg\FFMpeg;

class SetVideoMetadata
{
    public function __invoke(Video $model, Closure $next): mixed
    {
        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries' => config('media-library.ffmpeg_path'),
            'ffprobe.binaries' => config('media-library.ffprobe_path'),
            'ffmpeg.threads' => 0,
            'timeout' => 60 * 20,
        ]);

        $model->clips->each(function (Media $media) use ($ffmpeg) {
            $format = $ffmpeg->getFFProbe()->format($media->getPath());
            $stream = $ffmpeg->getFFProbe()->streams($media->getPath())->videos()->first();

            // Format properties
            $media->setCustomProperty('duration', $format->get('duration', '0'));
            $media->setCustomProperty('bitrate', $format->get('bit_rate', '0'));
            $media->setCustomProperty('probe_score', $format->get('probe_score', 0));

            // Stream properties
            $media->setCustomProperty('codec_name', $stream->get('codec_name', 'N/A'));
            $media->setCustomProperty('width', $stream->get('width', 0));
            $media->setCustomProperty('height', $stream->get('height', 0));
            $media->setCustomProperty('closed_captions', $stream->get('closed_captions', 0));
            $media->setCustomProperty('pix_fmt', $stream->get('pix_fmt', 'N/A'));
            $media->saveOrFail();
        });

        return $next($model);
    }
}
