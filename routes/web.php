<?php

use App\Web\Library\Controllers\LibraryIndexController;
use App\Web\Lists\Controllers\ListIndexController;
use App\Web\Lists\Controllers\ListViewController;
use App\Web\Search\Controllers\SearchIndexController;
use App\Web\Tags\Controllers\TagViewController;
use App\Web\Videos\Controllers\VideoIndexController;
use App\Web\Videos\Controllers\VideoViewController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', VideoIndexController::class)->name('home');

    // Videos
    Route::name('videos.')->prefix('videos')->group(function () {
        Route::get('/', VideoIndexController::class)->name('index');
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

    // Lists
    Route::name('lists.')->prefix('lists')->group(function () {
        Route::get('/', ListIndexController::class)->name('index');
        Route::get('/{playlist}', ListViewController::class)->name('view');
    });

    // Tags
    Route::name('tags.')->prefix('tags')->group(function () {
        Route::get('/{tag}', TagViewController::class)->name('view');
    });
});
