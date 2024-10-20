<?php

declare(strict_types=1);

namespace Domain\Videos\DataObjects;

use Spatie\LaravelData\Data;

class VideoableData extends Data
{
    public function __construct(
        public ?string $caption = null,
        public ?float $time = null,
    ) {}
}
