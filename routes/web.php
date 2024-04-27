<?php

use App\Feed\Http\Controllers\VideoIndexController;
use App\Feed\Http\Controllers\VideoViewController;
use Foxws\WireUse\Facades\WireUse;
use Illuminate\Support\Facades\Route;

// Auth
WireUse::routes();

// App
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', VideoIndexController::class)->name('home');

    // Videos
    Route::name('videos.')->group(function () {
        Route::get('/{video}', VideoViewController::class)->name('view');
    });
});
