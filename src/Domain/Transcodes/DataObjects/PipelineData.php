<?php

declare(strict_types=1);

namespace Domain\Transcodes\DataObjects;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class PipelineData extends Data
{
    public function __construct(
        public Optional|string $streaming_mode,
        public Optional|bool $quiet,
        public Optional|bool $debug_logs,
        public Optional|string $hwaccel_api,
        public Optional|array $resolutions,
        public Optional|array $channel_layouts,
        public Optional|array $audio_codecs,
        public Optional|array $video_codecs,
        public Optional|array $manifest_format,
        public Optional|string $dash_output,
        public Optional|string $hls_output,
        public Optional|string $segment_folder,
        public Optional|float $segment_size,
        public Optional|bool $segment_per_file,
        public Optional|bool $generate_iframe_playlist,
        public Optional|int $availability_window,
        public Optional|int $presentation_delay,
        public Optional|int $update_period,
        public Optional|bool $low_latency_dash_mode,
        public Optional|array $utc_timings,
        public Optional|EncryptionData $encryption,
    ) {}
}
