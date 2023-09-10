<?php

use App\Web\Profile\Controllers\FavoritesController;
use App\Web\Profile\Controllers\HistoryController;
use App\Web\Profile\Controllers\WatchlistController;
use App\Web\Tags\Controllers\TagIndexController;
use App\Web\Videos\Controllers\VideoIndexController;
use App\Web\Videos\Controllers\VideoViewController;
use Illuminate\Support\Facades\Route;

// Profile
Route::name('profile.')->middleware('auth')->group(function () {
    Route::get('/history', HistoryController::class)->name('history')->lazy();
    Route::get('/favorites', FavoritesController::class)->name('favorites')->lazy();
    Route::get('/watchlist', WatchlistController::class)->name('watchlist')->lazy();
});

// Videos
Route::name('videos.')->middleware('auth')->group(function () {
    Route::get('/', VideoIndexController::class)->name('index')->lazy();
    Route::get('/video/{video}', VideoViewController::class)->name('view');
});

// Tags
Route::name('tags.')->prefix('tags')->middleware('auth')->group(function () {
    Route::get('/', TagIndexController::class)->name('index')->lazy();
});
