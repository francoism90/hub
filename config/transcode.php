<?php

return [

    'disk_name' => env('TRANSCODE_DISK', 'transcode'),

    'segment_length' => (int) env('TRANSCODE_SEGMENT_LENGTH', 10),

    'frame_interval' => (int) env('TRANSCODE_FRAME_INTERVAL', 48),

    'max_disk_usage' => (int) env('TRANSCODE_MAX_DISK_USAGE', 100 * 1024 * 1024 * 1024), // 100 GB

    'formats' => [
        ['name' => 'default', 'video_bitrate' => 0],
    ],

    'container' => \Support\FFMpeg\Format\Video\X264::class,

    'copy_video_codecs' => [
        'libx264',
        'h264',
    ],

    'copy_audio_codecs' => [
        'aac',
        'libfaac',
        'libfdk_aac',
        'libopus',
        'libvo_aacenc',
        'libvorbis',
    ],

];
