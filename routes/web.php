<?php

use App\Web\Account\Controllers\NotificationsController;
use App\Web\Account\Controllers\ProfileController;
use App\Web\Account\Controllers\SubscribeController;
use App\Web\Account\Controllers\LibraryController;
use App\Web\Groups\Controllers\GroupViewController;
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
        Route::get('/library', LibraryController::class)->name('library');
    });

    // Videos
    Route::name('videos.')->prefix('video')->group(function () {
        Route::get('/{video}', VideoViewController::class)->name('view');
        Route::get('/{video}/edit', VideoEditController::class)->name('edit');
    });

    // Groups
    Route::name('groups.')->prefix('groups')->group(function () {
        Route::get('/{group}', GroupViewController::class)->name('view');
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
