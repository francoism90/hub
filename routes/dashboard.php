<?php

use App\Videos\Controllers\VideoIndexController;
use Illuminate\Support\Facades\Route;

// App
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', VideoIndexController::class)->name('home');
});
