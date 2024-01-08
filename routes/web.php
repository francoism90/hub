<?php

use App\Web\Home\Controllers\HomeController;
use App\Web\Profile\Controllers\FavoritesController;
use App\Web\Profile\Controllers\HistoryController;
use App\Web\Profile\Controllers\WatchlistController;
use App\Web\Search\Controllers\SearchIndexController;
use App\Web\Tags\Controllers\TagIndexController;
use App\Web\Videos\Controllers\VideoViewController;
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
