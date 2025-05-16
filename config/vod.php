<?php

return [

    /*
    |--------------------------------------------------------------------------
    | VOD URL
    |--------------------------------------------------------------------------
    |
    | This configures the VOD URL.
    |
    */

    'url' => env('VOD_URL'),

    'live_url' => env('VOD_LIVE_URL'),

    /*
    |--------------------------------------------------------------------------
    | VOD Format Parameters
    |--------------------------------------------------------------------------
    |
    | This configures the VOD options.
    |
    */

    'format' => env('VOD_FORMAT', 'dash'),

    /*
    |--------------------------------------------------------------------------
    | VOD DASH Parameters
    |--------------------------------------------------------------------------
    |
    | This configures the VOD DASH parameters.
    |
    */

    'dash' => [
        'path' => env('VOD_DASH_PATH', 'dash'),
        'name' => env('VOD_DASH_NAME', 'manifest.mpd'),
    ],

    /*
    |--------------------------------------------------------------------------
    | VOD HLS Parameters
    |--------------------------------------------------------------------------
    |
    | This configures the VOD HLS parameters.
    |
    */

    'hls' => [
        'path' => env('VOD_HLS_PATH', 'hls'),
        'name' => env('VOD_HLS_NAME', 'master.m3u8'),
    ],

];
