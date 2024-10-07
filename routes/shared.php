<?php

use App\Api\Users\Controllers\SubscriptionController;
use App\Api\Videos\Controllers\ManifestController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->prefix('api/v1')->group(function () {
    // Authorization
    Route::get('/subscription', SubscriptionController::class)->name('subscription');

    // Videos
    Route::name('videos.')->prefix('videos')->group(function () {
        Route::get('/{video}/manifest/{type}', ManifestController::class)->name('manifest');
    });
});
