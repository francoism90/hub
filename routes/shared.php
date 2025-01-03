<?php

declare(strict_types=1);

use App\Api\Media\Controllers\AssetController;
use App\Api\Media\Controllers\DownloadController;
use App\Api\Media\Controllers\ResponsiveController;
use App\Api\Users\Controllers\SubscriptionController;
use App\Api\Videos\Controllers\ManifestController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->prefix('api/v1')->group(function () {
    // Authorization
    Route::get('/subscription', SubscriptionController::class)->name('subscription');

    // Media
    Route::name('media.')->group(function () {
        Route::get('/asset/{media}/{conversion?}', AssetController::class)->name('asset');
        Route::get('/download/{media}/{conversion?}', DownloadController::class)->name('download');
        Route::get('/responsive/{media}/{conversion?}', ResponsiveController::class)->name('responsive');
    });

    // Videos
    Route::name('videos.')->prefix('videos')->group(function () {
        Route::get('/{video}/manifest/{type}', ManifestController::class)->name('manifest');
    });
});
