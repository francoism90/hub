<?php

declare(strict_types=1);

use App\Web\Auth\Controllers\HomeController;
use App\Web\Entities\Controllers\EntityController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', HomeController::class)->name('home');

// Resources
Route::resources([
    // 'entities' => EntityController::class,
]);
