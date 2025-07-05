<?php

declare(strict_types=1);

namespace Domain\Transcodes\DataObjects;

use Spatie\LaravelData\Data;

class FormatData extends Data
{
    public function __construct(
        public string $name = 'default',
        public string $video_codec = 'h264',
        public string $audio_codec = 'aac',
        public int $video_bitrate = 1500,
        public array $additional_parameters = [],
        public bool $copyVideo = true,
        public bool $copyAudio = true,
    ) {}
}
