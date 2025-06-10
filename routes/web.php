<?php

declare(strict_types=1);

use App\Web\Videos\Controllers\VideoIndexController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', VideoIndexController::class)->name('home');
