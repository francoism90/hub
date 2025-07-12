<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Closure;
use Domain\Transcodes\Models\Transcode;
use Domain\Videos\Models\Video;
use FFMpeg\Format\Video\DefaultVideo;
use Illuminate\Support\Facades\DB;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class CreateVideoTranscode
{
    public function handle(Video $video, Closure $next): mixed
    {
        return DB::transaction(function () use ($video, $next) {
            $media = $video->getClipCollection()->first();

            if (! $media) {
                return $next($video);
            }

            // Make sure transcode record exists
            $transcode = $video->transcodes()->create([
                'file_name' => 'index.m3u8',
                'disk' => Transcode::getDestinationDisk(),
                'expires_at' => Transcode::getExpiresAfter(),
            ]);

            // Initialize ffmpeg exporter
            $ffmpeg = FFMpeg::fromDisk($media->disk)
                ->open($media->getPathRelativeToRoot())
                ->exportForHLS()
                ->withoutPlaylistEndLine()
                ->toDisk($transcode->disk)
                ->setSegmentLength(Transcode::getSegmentLength())
                ->setKeyFrameInterval(Transcode::getFrameInterval());

            // Validate codecs and formats
            $formats = Transcode::getVideoFormats();

            $videoCodec = $ffmpeg->getVideoStream()->get('codec_name');
            $audioCodec = $ffmpeg->getAudioStream()->get('codec_name');

            $format = $formats->first(
                fn (DefaultVideo $videoFormat) => method_exists($videoFormat, 'getAvailableVideoCodecs')
                    && in_array($audioCodec, $videoFormat->getAvailableAudioCodecs())
                    && in_array($videoCodec, $videoFormat->getAvailableVideoCodecs()),
                fn () => $formats->first()
            );

            // Check if the format can be copied or needs transcoding
            $copyAudioFormat = (Transcode::copyAudioCodec() && in_array($audioCodec, $format->getAvailableAudioCodecs()));
            $copyVideoFormat = (Transcode::copyVideoCodec() && in_array($videoCodec, $format->getAvailableVideoCodecs()));

            // Add the format to the ffmpeg exporter
            $ffmpeg->addFormat(
                $format
                    ->setAudioCodec($copyAudioFormat ? 'copy' : $format->getAudioCodec())
                    ->setVideoCodec($copyVideoFormat ? 'copy' : $format->getVideoCodec())
                    ->setKiloBitrate(Transcode::getKiloBitrate()) // on copy, this is ignored
                    ->setPasses(Transcode::getPasses()) // on copy, this is ignored
                    ->setAdditionalParameters(Transcode::getAdditionalParameters())
            );

            // Run the transcoding process
            $ffmpeg->save("{$transcode->getPath()}/{$transcode->file_name}");

            // Mark the transcode as finished
            $transcode->updateOrFail(['finished_at' => now()]);

            return $next($video);
        });
    }
}
