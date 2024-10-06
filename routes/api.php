<?php

use App\Api\Authentication\Controllers\HomeController;
use App\Api\Videos\Controllers\HistoryController;
use App\Api\Videos\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->prefix('v1')->group(function () {
    // Home
    Route::get('/', HomeController::class)->name('home');

    // Authentication
    Route::get('/subscription', SubscriptionController::class)->name('subscription');

    // Videos
    Route::post('/history/{video}', HistoryController::class)->name('history');
});
