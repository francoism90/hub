<?php

use App\Web\Videos\Controllers\VideoIndexController;
use App\Web\Videos\Controllers\VideoViewController;
use Illuminate\Support\Facades\Route;

Route::name('videos.')->middleware('auth')->group(function () {
    Route::get('/', VideoIndexController::class)->name('index');
    Route::get('/video/{video}', VideoViewController::class)->name('view');
});
