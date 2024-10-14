<?php

use App\Web\Account\Controllers\NotificationsController;
use App\Web\Account\Controllers\ProfileController;
use App\Web\Account\Controllers\SubscribeController;
use App\Web\Groups\Controllers\GroupIndexController;
use App\Web\Groups\Controllers\GroupViewController;
use App\Web\Library\Controllers\LibraryIndexController;
use App\Web\Groups\Controllers\ListIndexController;
use App\Web\Groups\Controllers\ListViewController;
use App\Web\Search\Controllers\SearchIndexController;
use App\Web\Tags\Controllers\TagEditController;
use App\Web\Tags\Controllers\TagViewController;
use App\Web\Videos\Controllers\VideoEditController;
use App\Web\Videos\Controllers\VideoIndexController;
use App\Web\Videos\Controllers\VideoViewController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    // Home
    Route::get('/', LibraryIndexController::class)->name('home');

    // Account
    Route::name('account.')->group(function () {
        Route::get('/profile', ProfileController::class)->name('profile');
        Route::get('/notifications', NotificationsController::class)->name('notifications');
        Route::get('/subscribe', SubscribeController::class)->name('subscribe');
    });

    // Videos
    Route::name('videos.')->prefix('videos')->group(function () {
        Route::get('/', VideoIndexController::class)->name('index');
        Route::get('/{video}', VideoViewController::class)->name('view');
        Route::get('/{video}/edit', VideoEditController::class)->name('edit');
    });

    // Library
    Route::name('library.')->prefix('library')->group(function () {
        Route::get('/', SearchIndexController::class)->name('index');
    });

    // Search
    Route::name('search.')->prefix('search')->group(function () {
        Route::get('/', SearchIndexController::class)->name('index');
    });

    // Lists
    Route::name('lists.')->prefix('lists')->group(function () {
        Route::get('/', GroupIndexController::class)->name('index');
        Route::get('/{group}', GroupViewController::class)->name('view');
    });

    // Tags
    Route::name('tags.')->prefix('tags')->group(function () {
        Route::get('/{tag}', TagViewController::class)->name('view');
        Route::get('/{tag}/edit', TagEditController::class)->name('edit');
    });
});
