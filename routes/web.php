<?php

use App\Web\Videos\Controllers\VideoIndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', VideoIndexController::class)->middleware('auth');

// Route::fallback(fn () => abort(404));
