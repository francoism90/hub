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

    /*
    |--------------------------------------------------------------------------
    | VOD DASH Parameters
    |--------------------------------------------------------------------------
    |
    | This configures the VOD DASH parameters.
    |
    */

    'dash' => [
        'url' => env('VOD_DASH_URL'),

        'path' => env('VOD_DASH_PATH', 'dash'),

        'remote_path' => env('VOD_DASH_REMOTE_PATH', 'remote/dash'),
    ],

];
