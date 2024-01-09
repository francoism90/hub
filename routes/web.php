<?php

use App\Home\Controllers\HomeController;
use App\Profile\Controllers\FavoritesController;
use App\Profile\Controllers\HistoryController;
use App\Profile\Controllers\WatchlistController;
use App\Search\Controllers\SearchIndexController;
use App\Tags\Controllers\TagIndexController;
use App\Videos\Controllers\VideoViewController;
use Foxws\LivewireUse\Facades\LivewireUse;
use Illuminate\Support\Facades\Route;

// Auth
LivewireUse::routes();

// App
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', HomeController::class)->name('home');
    Route::get('/search', SearchIndexController::class)->name('search');

    // Profile
    Route::name('profile.')->group(function () {
        Route::get('/history', HistoryController::class)->name('history');
        Route::get('/favorites', FavoritesController::class)->name('favorites');
        Route::get('/watchlist', WatchlistController::class)->name('watchlist');
    });

    // Videos
    Route::name('videos.')->group(function () {
        Route::get('/video/{video}', VideoViewController::class)->name('view');
    });

    // Tags
    Route::name('tags.')->prefix('tags')->group(function () {
        Route::get('/', TagIndexController::class)->name('index');
    });
});
