<?php

use App\Web\Playlists\Controllers\PlaylistIndexController;
use App\Web\Tags\Controllers\TagIndexController;
use App\Web\Videos\Controllers\VideoIndexController;
use App\Web\Videos\Controllers\VideoViewController;
use Illuminate\Support\Facades\Route;

// Videos
Route::name('videos.')->middleware('auth')->group(function () {
    Route::get('/', VideoIndexController::class)->name('index');
    Route::get('/video/{video}', VideoViewController::class)->name('view');
});

// Tags
Route::name('tags.')->prefix('tags')->middleware('auth')->group(function () {
    Route::get('/', TagIndexController::class)->name('index');
});

// Playlists
Route::name('playlists.')->prefix('playlists')->middleware('auth')->group(function () {
    Route::get('/', PlaylistIndexController::class)->name('index');
});
