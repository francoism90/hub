<?php

use Illuminate\Support\Facades\Route;

Route::fallback(fn () => abort(404));
