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
        public string $videoCodec = 'libx264',
        public string $audioCodec = 'aac',
        public int $bitrate = 0,
        public int $passes = 1,
        public array $parameters = [],
        public bool $copyVideo = true,
        public bool $copyAudio = true,
    ) {}
}
