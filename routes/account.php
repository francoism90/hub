<?php

use App\Web\Account\Controllers\NotificationsController;
use App\Web\Account\Controllers\ProfileController;
use App\Web\Tags\Controllers\TagEditController;
use App\Web\Videos\Controllers\VideoEditController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', ProfileController::class)->name('profile');

    // Notifications
    Route::name('notifications.')->prefix('notifications')->group(function () {
        Route::get('/', NotificationsController::class)->name('index');
    });

    // Videos
    Route::name('videos.')->prefix('videos')->group(function () {
        Route::get('/{video}', VideoEditController::class)->name('edit');
    });

    // Tags
    Route::name('tags.')->prefix('tags')->group(function () {
        Route::get('/{tag}', TagEditController::class)->name('edit');
    });
});
