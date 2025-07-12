<?php

declare(strict_types=1);

use App\Api\Authentication\Controllers\HomeController;
use App\Api\Transcodes\Controllers\TranscodeMediaController;
use App\Api\Transcodes\Controllers\TranscodePlaylistController;
use App\Api\Videos\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->prefix('v1')->group(function () {
    // Authentication
    Route::get('/', HomeController::class)->name('home');

    // Videos
    Route::apiResource('videos', VideoController::class);

    // Transcodes
    Route::name('transcodes.')->prefix('play')->group(function () {
        Route::get('/{transcode}/media/{path}', TranscodeMediaController::class)->name('media');
        Route::get('/{transcode}/playlist/{path}', TranscodePlaylistController::class)->name('playlist');
    });
});
