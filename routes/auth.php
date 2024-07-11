<?php

use App\Web\Auth\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/login', LoginController::class)->middleware('guest')->name('login');
// Route::get('/register', RegisterController::class)->middleware('guest')->name('register');
// Route::post('/logout', LogoutController::class)->name('logout');
