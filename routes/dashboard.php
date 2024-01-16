<?php

use App\Dashboard\Controllers\DashboardIndexController;
use Illuminate\Support\Facades\Route;

// App
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', DashboardIndexController::class)->name('index');
});
