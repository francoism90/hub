<?php

declare(strict_types=1);

use App\Api\Authentication\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->prefix('v1')->group(function () {
    // Authentication
    Route::get('/', HomeController::class)->name('home');
});
