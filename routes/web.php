<?php

use App\Web\Videos\Controllers\VideoIndexController;
use App\Web\Videos\Controllers\VideoViewController;
use Foxws\WireUse\Facades\WireUse;
use Illuminate\Support\Facades\Route;

// Auth
WireUse::routes();

// App
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', VideoIndexController::class)->name('home');
    Route::get('/search', VideoIndexController::class)->name('search');

    // Videos
    Route::name('videos.')->prefix('videos')->group(function () {
        Route::get('/{video}', VideoViewController::class)->name('view');
    });

    // // Tags
    // Route::name('tags.')->prefix('tags')->group(function () {
    //     Route::get('/{tag}', TagViewController::class)->name('view');
    // });
});
