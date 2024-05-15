<?php

use App\Feed\Http\Controllers\FeedIndexController;
use App\Videos\Http\Controllers\VideoViewController;
use Foxws\WireUse\Facades\WireUse;
use Illuminate\Support\Facades\Route;

// Auth
WireUse::routes();

// App
Route::middleware(['auth', 'verified'])->group(function () {
    // Feed
    Route::get('/', FeedIndexController::class)->name('home');

    // Videos
    Route::name('videos.')->group(function () {
        Route::get('/play/{video}', VideoViewController::class)->name('view');
    });
});
