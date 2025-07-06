<?php

declare(strict_types=1);

namespace Domain\Transcodes\DataObjects;

use Spatie\LaravelData\Data;
use Support\FFMpeg\Format\Video\X264;

class FormatData extends Data
{
    public function __construct(
        public string $name = 'default',
        public string $container = X264::class,
        public string $video_codec = 'h264',
        public string $audio_codec = 'aac',
        public int $video_bitrate = 1500,
        public array $additional_parameters = [],
        public bool $copyVideo = true,
        public bool $copyAudio = true,
    ) {}
}
