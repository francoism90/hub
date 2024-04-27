<?php

use App\Dashboard\Http\Controllers\DashboardContentController;
use App\Dashboard\Http\Controllers\DashboardIndexController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    // App
    Route::get('/', DashboardIndexController::class)->name('index');
    Route::get('/content', DashboardContentController::class)->name('content');
    Route::get('/post', DashboardContentController::class)->name('post');
    Route::get('/settings', DashboardContentController::class)->name('settings');
    Route::get('/activity', DashboardContentController::class)->name('activity');

    // Videos
    Route::name('videos.')->group(function () {
        // Route::get('/{video}', VideoViewController::class)->name('view');
    });
});
