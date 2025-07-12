<?php

return [

    'disk_name' => env('TRANSCODE_DISK', 'transcode'),

    'max_disk_usage' => (int) env('TRANSCODE_MAX_DISK_USAGE', 100 * 1024 * 1024 * 1024), // 100 GB

    'expires_after' => (int) env('TRANSCODE_EXPIRES_AFTER', 60 * 60 * 4), // 4 hours

    'segment_length' => (int) env('TRANSCODE_SEGMENT_LENGTH', 10),

    'frame_interval' => (int) env('TRANSCODE_FRAME_INTERVAL', 48),

    'kilo_bitrate' => (int) env('TRANSCODE_KILO_BITRATE', 1500),

    'passes' => (int) env('TRANSCODE_PASSES', 1),

    'copy_video_codec' => (bool) env('TRANSCODE_COPY_VIDEO_CODEC', true),

    'copy_audio_codec' => (bool) env('TRANSCODE_COPY_AUDIO_CODEC', true),

    'additional_parameters' => (array) env('TRANSCODE_ADDITIONAL_PARAMETERS', []),

    'video_formats' => [
        \Support\FFMpeg\Format\Video\X264::class,
        // \Support\FFMpeg\Format\Video\X265::class,
        \Support\FFMpeg\Format\Video\WebM::class,
    ],

];
