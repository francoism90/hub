<?php

use App\Dashboard\Http\Controllers\DashboardIndexController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    // App
    Route::get('/', DashboardIndexController::class)->name('index');
});
