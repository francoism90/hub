<?php

declare(strict_types=1);

use App\Web\Dashboard\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', HomeController::class)->name('home');

// Resources
// Route::resources([
// 'entities' => EntityController::class,
// ]);
