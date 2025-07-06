<?php

declare(strict_types=1);

namespace Domain\Transcodes\Actions;

use Closure;
use Domain\Transcodes\DataObjects\FormatData;
use Domain\Transcodes\Models\Transcode;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class GenerateHlsTranscode
{
    public function handle(Transcode $transcode, Closure $next): mixed
    {
        $pipeline = $transcode->pipeline;

        $ffmpeg = FFMpeg::fromDisk($pipeline->disk)
            ->open($pipeline->path)
            ->exportForHLS()
            ->withoutPlaylistEndLine()
            ->toDisk($pipeline->destination)
            ->setSegmentLength($pipeline->segmentLength)
            ->setKeyFrameInterval($pipeline->frameInterval);

        $copyVideoFormat = ($video = $ffmpeg->getVideoStream()) && in_array($video->get('codec_name'), Transcode::copyVideoCodec());
        $copyAudioFormat = ($audio = $ffmpeg->getAudioStream()) && in_array($audio->get('codec_name'), Transcode::copyAudioCodec());

        logger($video->get('codec_name'));
        logger($audio->get('codec_name'));

        $pipeline->formats->each(fn (FormatData $format) => $ffmpeg->addFormat(app($format->container)
            ->setVideoCodec($format->copyVideo && $copyVideoFormat ? 'copy' : $format->videoCodec)
            ->setAudioCodec($format->copyAudio && $copyAudioFormat ? 'copy' : $format->audioCodec)
            ->setKiloBitrate($format->bitrate)
            ->setPasses($format->passes)
            ->setAdditionalParameters($format->parameters)
        ));

        $ffmpeg->save("{$transcode->getPath()}/{$pipeline->name}");

        return $next($transcode);
    }
}
