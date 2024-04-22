<?php

use App\Dashboard\Http\Controllers\DashboardContentController;
use App\Dashboard\Http\Controllers\DashboardIndexController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', DashboardIndexController::class)->name('index');
    Route::get('/content', DashboardContentController::class)->name('content');
});
