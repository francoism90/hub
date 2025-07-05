<?php

declare(strict_types=1);

namespace Domain\Transcodes\Actions;

use Domain\Transcodes\DataObjects\PipelineData;
use FFMpeg\Format\Video\DefaultVideo;
use ProtoneMedia\LaravelFFMpeg\MediaOpener;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Support\FFMpeg\Format\Video\X264;

class GenerateHlsTranscode
{
    public function handle(PipelineData $pipeline): MediaOpener
    {
        $ffmpeg = FFMpeg::fromDisk($pipeline->disk)
            ->open($pipeline->path)
            ->exportForHLS()
            ->setSegmentLength($pipeline->segmentLength)
            ->setKeyFrameInterval($pipeline->frameInterval)
            ->toDisk($pipeline->destination);

        $copyVideoFormat = ($video = $ffmpeg->getVideoStream()) && in_array($video->get('codec_name'), $this->copyVideoCodec());

        $copyAudioFormat = ($audio = $ffmpeg->getAudioStream()) && in_array($audio->get('codec_name'), $this->copyAudioCodec());

        foreach ($pipeline->formats as $format) {
            $ffmpeg->addFormat($this->videoFormat()
                ->setVideoCodec($copyVideoFormat ? 'copy' : $format->video_codec)
                ->setAudioCodec($copyAudioFormat ? 'copy' : $format->audio_codec)
                ->setKiloBitrate($format->video_bitrate)
                ->setAdditionalParameters($format->additional_parameters)
            );
        }

        return $ffmpeg->save($pipeline->name);
    }

    protected function videoFormat(): DefaultVideo
    {
        return app(config('transcode.video_format', X264::class));
    }

    protected function copyVideoCodec(): array
    {
        return config('transcode.copy_video_codecs', []);
    }

    protected function copyAudioCodec(): array
    {
        return config('transcode.copy_audio_codecs', []);
    }
}
