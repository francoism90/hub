<?php

declare(strict_types=1);

use App\Marketing\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', HomeController::class)->name('home');
