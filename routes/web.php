<?php

use App\Web\Account\Controllers\NotificationsController;
use App\Web\Library\Controllers\LibraryIndexController;
use App\Web\Lists\Controllers\ListIndexController;
use App\Web\Search\Controllers\SearchIndexController;
use App\Web\Tags\Controllers\TagViewController;
use App\Web\Videos\Controllers\VideoIndexController;
use App\Web\Videos\Controllers\VideoViewController;
use Foxws\WireUse\Facades\WireUse;
use Illuminate\Support\Facades\Route;

// Auth
// WireUse::routes();

// App
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', VideoIndexController::class)->name('home');

    // Account
    Route::name('account.')->prefix('account')->group(function () {
        Route::get('/notifications', NotificationsController::class)->name('notifications');
    });

    // Videos
    Route::name('videos.')->prefix('videos')->group(function () {
        Route::get('/', VideoIndexController::class)->name('index');
        Route::get('/{video}', VideoViewController::class)->name('view');
    });

    // Library
    Route::name('library.')->prefix('library')->group(function () {
        Route::get('/', LibraryIndexController::class)->name('index');
    });

    // Search
    Route::name('search.')->prefix('search')->group(function () {
        Route::get('/', SearchIndexController::class)->name('index');
    });

    // Lists
    Route::name('lists.')->prefix('lists')->group(function () {
        Route::get('/', ListIndexController::class)->name('index');
    });

    // Tags
    Route::name('tags.')->prefix('tags')->group(function () {
        Route::get('/{tag}', TagViewController::class)->name('view');
    });
});
