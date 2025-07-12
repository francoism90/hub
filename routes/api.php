<?php

declare(strict_types=1);

use App\Api\Authentication\Controllers\HomeController;
use App\Api\Playlists\Controllers\MediaController;
use App\Api\Playlists\Controllers\PlaylistController;
use App\Api\Videos\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->prefix('v1')->group(function () {
    // Authentication
    Route::get('/', HomeController::class)->name('home');

    // Videos
    Route::apiResource('videos', VideoController::class);

    // Playlists
    Route::name('playlists.')->prefix('play')->group(function () {
        Route::get('/{transcode}/media/{path}', MediaController::class)->name('media')->where('path', '.*');
        Route::get('/{transcode}/playlist/{path}', PlaylistController::class)->name('playlist')->where('path', '.*');
    });
});
