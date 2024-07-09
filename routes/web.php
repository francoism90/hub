<?php

use App\Web\Library\Controllers\LibraryIndexController;
use App\Web\Search\Controllers\SearchIndexController;
use App\Web\Videos\Controllers\VideoIndexController;
use App\Web\Videos\Controllers\VideoViewController;
use Foxws\WireUse\Facades\WireUse;
use Illuminate\Support\Facades\Route;

// Auth
WireUse::routes();

// App
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', VideoIndexController::class)->name('home');

    // Videos
    Route::name('videos.')->prefix('videos')->group(function () {
        // Route::get('/', VideoIndexController::class)->name('home');
        Route::get('/{video}', VideoViewController::class)->name('view');
    });

    // Library
    Route::name('library.')->prefix('library')->group(function () {
        Route::get('/', LibraryIndexController::class)->name('index');
    });

    // Search
    Route::name('search.')->prefix('search')->group(function () {
        Route::get('/', SearchIndexController::class)->name('index');
    });

    // Tags
    // Route::name('tags.')->prefix('tags')->group(function () {
    //     Route::get('/{tag}', TagViewController::class)->name('view');
    // });
});
