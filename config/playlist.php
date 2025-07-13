<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Transcode Disk
    |--------------------------------------------------------------------------
    |
    | This disk is used to store the transcoded video playlists.
    |
    */

    'enabled' => (bool) env('PLAYLIST_ENABLED', true),

    'disk_name' => env('PLAYLIST_DISK', 'transcode'),

    'max_disk_usage' => (int) env('PLAYLIST_MAX_DISK_USAGE', 100 * 1024 * 1024 * 1024), // 100 GB

    'expires_after' => (int) env('PLAYLIST_EXPIRES_AFTER', 60 * 60 * 4), // 4 hours

    /*
    |--------------------------------------------------------------------------
    | HLS Configuration
    |--------------------------------------------------------------------------
    |
    | These settings are used to configure the HLS playlist generation.
    |
    */

    'hls_playlists' => [
        ['name' => 'default', 'bit_rate' => 1500],
        // ['name' => 'low', 'bit_rate' => 500],
        // ['name' => 'mid', 'bit_rate' => 3000],
        // ['name' => 'high', 'bit_rate' => 6000],
        // ['name' => 'ultra', 'bit_rate' => 9000],
    ],

    'segment_length' => (int) env('PLAYLIST_SEGMENT_LENGTH', 10),

    'frame_interval' => (int) env('PLAYLIST_FRAME_INTERVAL', 48),

    /*
    |--------------------------------------------------------------------------
    | Video Format Selection
    |--------------------------------------------------------------------------
    |
    | These formats are used to determine the video codec compatibility.
    | The given order is important as it determines the fallback behavior.
    |
    */

    'video_formats' => [
        \Support\FFMpeg\Format\Video\X264::class,
        \Support\FFMpeg\Format\Video\X265::class,
        \Support\FFMpeg\Format\Video\WebM::class,
    ],

    'prevent_transcoding' => (bool) env('PLAYLIST_PREVENT_TRANSCODING', true),

    'copy_video_codec' => (bool) env('PLAYLIST_COPY_VIDEO_CODEC', true),

    'copy_audio_codec' => (bool) env('PLAYLIST_COPY_AUDIO_CODEC', true),

];
