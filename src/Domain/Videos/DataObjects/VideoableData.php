<?php

declare(strict_types=1);

namespace Domain\Videos\DataObjects;

use Carbon\CarbonImmutable;
use Spatie\LaravelData\Data;

class VideoableData extends Data
{
    public function __construct(
        public string $videoable_type,
        public int $videoable_id,
        public int $video_id,
        public CarbonImmutable $created_at,
        public CarbonImmutable $updated_at,
        public ?VideoableOptions $options = null,
    ) {}
}
