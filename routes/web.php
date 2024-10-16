<?php

use App\Web\Account\Controllers\FavoritesController;
use App\Web\Account\Controllers\HistoryController;
use App\Web\Account\Controllers\NotificationsController;
use App\Web\Account\Controllers\ProfileController;
use App\Web\Account\Controllers\SavedController;
use App\Web\Account\Controllers\SubscribeController;
use App\Web\Library\Controllers\LibraryIndexController;
use App\Web\Library\Controllers\LibraryViewedController;
use App\Web\Playlists\Controllers\PlaylistIndexController;
use App\Web\Playlists\Controllers\PlaylistViewController;
use App\Web\Search\Controllers\SearchIndexController;
use App\Web\Tags\Controllers\TagEditController;
use App\Web\Tags\Controllers\TagIndexController;
use App\Web\Tags\Controllers\TagViewController;
use App\Web\Videos\Controllers\VideoEditController;
use App\Web\Videos\Controllers\VideoIndexController;
use App\Web\Videos\Controllers\VideoViewController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    // Home
    Route::get('/', VideoIndexController::class)->name('home');

    // Account
    Route::name('account.')->group(function () {
        Route::get('/profile', ProfileController::class)->name('profile');
        Route::get('/notifications', NotificationsController::class)->name('notifications');
        Route::get('/subscribe', SubscribeController::class)->name('subscribe');
        Route::get('/history', HistoryController::class)->name('history');
        Route::get('/favorites', FavoritesController::class)->name('favorites');
        Route::get('/saved', SavedController::class)->name('saved');
    });

    // Videos
    Route::name('videos.')->prefix('video')->group(function () {
        Route::get('/{video}', VideoViewController::class)->name('view');
        Route::get('/{video}/edit', VideoEditController::class)->name('edit');
    });

    // Library
    Route::name('library.')->prefix('library')->group(function () {
        Route::get('/', LibraryIndexController::class)->name('index');
    });

    // Groups
    Route::name('playlists.')->prefix('playlist')->group(function () {
        Route::get('/', PlaylistIndexController::class)->name('index');
        Route::get('/{group}', PlaylistViewController::class)->name('view');
    });

    // Tags
    Route::name('tags.')->prefix('tag')->group(function () {
        Route::get('/', TagIndexController::class)->name('index');
        Route::get('/{tag}', TagViewController::class)->name('view');
        Route::get('/{tag}/edit', TagEditController::class)->name('edit');
    });

    // Search
    Route::name('search.')->prefix('search')->group(function () {
        Route::get('/', SearchIndexController::class)->name('index');
    });
});
