<?php

use App\Profile\Http\Controllers\FeedController;
use App\Profile\Http\Controllers\HistoryController;
use App\Search\Http\Controllers\SearchController;
use App\Tags\Http\Controllers\TagViewController;
use App\Videos\Http\Controllers\VideoViewController;
use Foxws\WireUse\Facades\WireUse;
use Illuminate\Support\Facades\Route;

// Auth
WireUse::routes();

// App
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', FeedController::class)->name('home');
    Route::get('/search', SearchController::class)->name('search');

    // Profile
    Route::name('profile.')->group(function () {
        Route::get('/history', HistoryController::class)->name('history');
        // Route::get('/favorites', FavoritesController::class)->name('favorites');
        // Route::get('/watchlist', WatchlistController::class)->name('watchlist');
    });

    // Videos
    Route::name('videos.')->prefix('videos')->group(function () {
        Route::get('/{video}', VideoViewController::class)->name('view');
    });

    // Tags
    Route::name('tags.')->prefix('tags')->group(function () {
        Route::get('/{tag}', TagViewController::class)->name('view');
    });
});
