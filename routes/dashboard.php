<?php

use App\Dashboard\Http\Controllers\ContentController;
use App\Dashboard\Http\Controllers\DashboardController;
use App\Dashboard\Http\Controllers\VideoEditController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    // App
    Route::get('/', DashboardController::class)->name('index');
    Route::get('/post', DashboardController::class)->name('post');
    Route::get('/settings', DashboardController::class)->name('settings');
    Route::get('/activity', DashboardController::class)->name('activity');

    // Content
    Route::name('content.')->prefix('content')->group(function () {
        Route::get('/', ContentController::class)->name('index');
    });

    // Videos
    Route::name('videos.')->prefix('videos')->group(function () {
        Route::get('/{video}', VideoEditController::class)->name('edit');
    });
});
