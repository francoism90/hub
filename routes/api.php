<?php

use App\Api\Authentication\Controllers\HomeController;
use App\Api\Media\Controllers\AssetController;
use App\Api\Media\Controllers\DownloadController;
use App\Api\Media\Controllers\ResponsiveController;
use App\Api\Videos\Controllers\ManifestController;
use App\Api\Videos\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->prefix('v1')->group(function () {
    // Home
    Route::get('/', HomeController::class)->name('home');

    // Media
    Route::name('media.')->prefix('media')->group(function () {
        Route::get('/asset/{media}/{conversion?}', AssetController::class)->name('asset');
        Route::get('/download/{media}/{conversion?}', DownloadController::class)->name('download');
        Route::get('/responsive/{media}/{conversion?}', ResponsiveController::class)->name('responsive');
    });

    // Videos
    Route::name('videos.')->prefix('videos')->group(function () {
        Route::get('/subscription', SubscriptionController::class)->name('subscription');
        Route::get('/{video}/manifest/{type}', ManifestController::class)->name('manifest');
    });
});
