<?php

declare(strict_types=1);

use App\Api\Authentication\Controllers\HomeController;
use App\Api\Videos\Controllers\VideoController;
use App\Api\Videos\Controllers\VideoMediaController;
use App\Api\Videos\Controllers\VideoPlaylistController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->prefix('v1')->group(function () {
    // Authentication
    Route::get('/', HomeController::class)->name('home');

    // Videos
    Route::apiResource('videos', VideoController::class);

    // VOD
    Route::name('vod.')->prefix('play')->group(function () {
        Route::get('/{video}/media/{path}', VideoMediaController::class)->name('media');
        Route::get('/{video}/playlist/{path}', VideoPlaylistController::class)->name('playlist');
    });
});
