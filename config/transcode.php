<?php

return [

    'disk' => env('TRANSCODE_DISK', 'transcode'),

    'formats' => [
        ['name' => 'default', 'video_bitrate' => 1500],
    ],

    'video_format' => \Support\FFMpeg\Format\Video\X264::class,

    'copy_video_codecs' => [
        'h264',
        'libx264',
    ],

    'copy_audio_codecs' => [
        'aac',
        'libvo_aacenc',
        'libfaac',
        'libmp3lame',
        'libfdk_aac',
    ],

];
