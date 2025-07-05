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
        public string $destination,
        public int $segmentLength,
        public int $frameInterval,
        public FormatDataCollection $formats,
    ) {
        $this->destination = (string) config('transcode.disk', 'transcode');
        $this->segmentLength = (int) config('transcode.segment_length', 10);
        $this->frameInterval = (int) config('transcode.frame_interval', 48);
        $this->formats = FormatDataCollection::from(config('transcode.formats', []));
    }
}
