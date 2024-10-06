<?php

use App\Web\Account\Controllers\NotificationsController;
use App\Web\Account\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/account', ProfileController::class)->name('profile');

    // Notifications
    Route::name('notifications.')->prefix('notifications')->group(function () {
        Route::get('/', NotificationsController::class)->name('index');
    });
});
