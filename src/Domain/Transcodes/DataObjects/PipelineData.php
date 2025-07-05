<?php

declare(strict_types=1);

namespace Domain\Transcodes\DataObjects;

use Spatie\LaravelData\Data;

class PipelineData extends Data
{
    public function __construct(
        public string $disk,
        public string $path,
        public string $name,
        public string $destination = 'transcode',
        public int $segmentLength = 10,
        public int $frameInterval = 48,
        public FormatDataCollection $formats,
    ) {
        //
    }
}
