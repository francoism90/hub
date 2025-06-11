<?php

declare(strict_types=1);

use App\Web\Account\Controllers\DiscoverController;
use App\Web\Videos\Controllers\VideoViewController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', DiscoverController::class)->name('home');

// Videos
Route::name('videos.')->prefix('videos')->group(function () {
    Route::get('/{video}', VideoViewController::class)->name('show');
});
