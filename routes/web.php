<?php

declare(strict_types=1);

use App\Web\Dashboard\Controllers\DashboardIndex;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', DashboardIndex::class)->name('home');

// Resources
// Route::resources([
// 'entities' => EntityController::class,
// ]);
