<?php

use App\Web\Account\Controllers\HistoryController;
use App\Web\Tags\Controllers\TagIndexController;
use App\Web\Videos\Controllers\VideoIndexController;
use App\Web\Videos\Controllers\VideoViewController;
use Illuminate\Support\Facades\Route;

// Account
Route::name('account.')->middleware('auth')->group(function () {
    Route::get('/history', HistoryController::class)->name('history');
});

// Videos
Route::name('videos.')->middleware('auth')->group(function () {
    Route::get('/', VideoIndexController::class)->name('index');
    Route::get('/video/{video}', VideoViewController::class)->name('view');
});

// Tags
Route::name('tags.')->prefix('tags')->middleware('auth')->group(function () {
    Route::get('/', TagIndexController::class)->name('index');
});
