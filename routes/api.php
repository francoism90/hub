<?php

use App\Api\Authentication\Controllers\HomeController;
use App\Api\Users\Controllers\SubscriptionController;
use App\Api\Videos\Controllers\ManifestController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->prefix('v1')->group(function () {
    // Authentication
    Route::get('/', HomeController::class)->name('home');
    Route::get('/subscription', SubscriptionController::class)->name('subscription');

    // Videos
    Route::name('videos.')->prefix('videos')->group(function () {
        Route::get('/{video}/manifest/{type}', ManifestController::class)->name('manifest');
    });
});
