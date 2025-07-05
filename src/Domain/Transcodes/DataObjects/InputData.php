<?php

declare(strict_types=1);

namespace Domain\Transcodes\DataObjects;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class InputData extends Data
{
    public function __construct(
        public Optional|string $name,
        public Optional|string $input_type,
        public Optional|string $extra_input_args,
        public Optional|string $media_type,
        public Optional|int $track_num,
        public Optional|string $start_time,
        public Optional|string $end_time,
        public Optional|string $drm_label,
        public Optional|int $skip_encryption,
        public Optional|string $filters,
        public Optional|bool $is_interlaced,
        public Optional|float $frame_rate,
        public Optional|string $resolution,
        public Optional|string $channel_layout,
        public Optional|string $language,
        public Optional|bool $forced_subtitle,
    ) {}
}