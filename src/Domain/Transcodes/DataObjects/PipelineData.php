<?php

declare(strict_types=1);

namespace Domain\Transcodes\DataObjects;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class PipelineData extends Data
{
    public function __construct(
        public string $disk,
        public string $path,
        public string $name,
        public Optional|string $destination,
        public Optional|int $segmentLength,
        public Optional|int $frameInterval,
        public FormatDataCollection $formats,
    ) {
        //
    }
}
