<?php

use App\Dashboard\Http\Controllers\ContentIndexController;
use App\Dashboard\Http\Controllers\DashboardIndexController;
use App\Dashboard\Http\Controllers\VideoEditController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    // App
    Route::get('/', DashboardIndexController::class)->name('index');
    Route::get('/post', ContentIndexController::class)->name('post');
    Route::get('/settings', ContentIndexController::class)->name('settings');
    Route::get('/activity', ContentIndexController::class)->name('activity');

    // Content
    Route::name('content.')->prefix('content')->group(function () {
        Route::get('/', ContentIndexController::class)->name('index');
    });

    // Videos
    Route::name('videos.')->prefix('videos')->group(function () {
        Route::get('/{video}', VideoEditController::class)->name('edit');
    });
});
