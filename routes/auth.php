<?php

use App\Web\Auth\Controllers\LoginController;
use App\Web\Auth\Controllers\LogoutController;

Route::get('/login', LoginController::class)->middleware('guest')->name('login');
Route::get('/logout', LogoutController::class)->name('logout');
