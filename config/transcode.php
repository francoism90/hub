<?php

return [

    'disk' => env('TRANSCODE_DISK', 'transcode'),

    'segment_length' => (int) env('TRANSCODE_SEGMENT_LENGTH', 10),

    'frame_interval' => (int) env('TRANSCODE_FRAME_INTERVAL', 48),

    'formats' => [
        ['name' => 'default', 'video_bitrate' => 0],
    ],

    'container' => \Support\FFMpeg\Format\Video\X264::class,

    'copy_video_codecs' => [
        'libx264',
    ],

    'copy_audio_codecs' => [
        'aac',
        'libfaac',
        'libfdk_aac',
        'libmp3lame',
        'libopus',
        'libvo_aacenc',
        'libvorbis',
    ],

];
