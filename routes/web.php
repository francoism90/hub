<?php

declare(strict_types=1);

use App\Web\Account\Controllers\DiscoverController;
use App\Web\Videos\Controllers\VideoIndexController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', DiscoverController::class)->name('home');

// Videos
Route::name('videos.')->prefix('videos')->group(function () {
    Route::get('/videos', VideoIndexController::class)->name('index');
    // Route::get('/create', VideoCreateController::class)->name('create');
    // Route::get('/{video}', VideoViewController::class)->name('show');
});
