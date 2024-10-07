<?php

use App\Api\Media\Controllers\AssetController;
use App\Api\Media\Controllers\DownloadController;
use App\Api\Media\Controllers\ResponsiveController;
use App\Api\Users\Controllers\SubscriptionController;
use App\Web\Account\Controllers\NotificationsController;
use App\Web\Account\Controllers\ProfileController;
use App\Web\Auth\Controllers\LoginController;
use App\Web\Auth\Controllers\LogoutController;
use App\Web\Library\Controllers\LibraryIndexController;
use App\Web\Lists\Controllers\ListIndexController;
use App\Web\Lists\Controllers\ListViewController;
use App\Web\Search\Controllers\SearchIndexController;
use App\Web\Tags\Controllers\TagEditController;
use App\Web\Tags\Controllers\TagViewController;
use App\Web\Videos\Controllers\VideoEditController;
use App\Web\Videos\Controllers\VideoIndexController;
use App\Web\Videos\Controllers\VideoViewController;
use Illuminate\Support\Facades\Route;

// Authentication
Route::name('auth.')->group(function () {
    Route::get('/login', LoginController::class)->middleware('guest')->name('login');
    Route::get('/logout', LogoutController::class)->name('logout');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Home
    Route::get('/', VideoIndexController::class)->name('home');

    // Account
    Route::name('account.')->group(function () {
        Route::get('/profile', ProfileController::class)->name('profile');
        Route::get('/notifications', NotificationsController::class)->name('notifications');
        Route::get('/subscribe', SubscriptionController::class)->name('subscribe');
    });

    // Media
    Route::name('media.')->group(function () {
        Route::get('/asset/{media}/{conversion?}', AssetController::class)->name('asset');
        Route::get('/download/{media}/{conversion?}', DownloadController::class)->name('download');
        Route::get('/responsive/{media}/{conversion?}', ResponsiveController::class)->name('responsive');
    });

    // Videos
    Route::name('videos.')->prefix('videos')->group(function () {
        Route::get('/', VideoIndexController::class)->name('index');
        Route::get('/{video}', VideoViewController::class)->name('view');
        Route::get('/{video}/edit', VideoEditController::class)->name('edit');
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
        Route::get('/{playlist}', ListViewController::class)->name('view');
    });

    // Tags
    Route::name('tags.')->prefix('tags')->group(function () {
        Route::get('/{tag}', TagViewController::class)->name('view');
        Route::get('/{tag}/edit', TagEditController::class)->name('edit');
    });
});
