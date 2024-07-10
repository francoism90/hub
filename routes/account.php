<?php

use App\Web\Account\Controllers\NotificationsController;
use App\Web\Videos\Controllers\VideoEditController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', NotificationsController::class)->name('notifications');

    // Videos
    Route::name('videos.')->prefix('videos')->group(function () {
        Route::get('/{video}', VideoEditController::class)->name('edit');
    });
});
