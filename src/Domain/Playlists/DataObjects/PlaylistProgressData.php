<?php

declare(strict_types=1);

namespace Domain\Playlists\DataObjects;

use Spatie\LaravelData\Data;

class PlaylistProgressData extends Data
{
    public function __construct(
        public ?float $percentage = null,
        public ?float $remaining = null,
        public ?float $rate = null,
    ) {}
}
