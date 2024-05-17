<?php

use App\Discover\Http\Controllers\DiscoverIndexController;
use App\Feed\Http\Controllers\FeedIndexController;
use App\Videos\Http\Controllers\VideoViewController;
use Foxws\WireUse\Facades\WireUse;
use Illuminate\Support\Facades\Route;

// Auth
WireUse::routes();

// App
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', FeedIndexController::class)->name('home');
    Route::get('/discover', DiscoverIndexController::class)->name('discover');

    // Videos
    Route::name('videos.')->group(function () {
        Route::get('/play/{video}', VideoViewController::class)->name('view');
    });
});
