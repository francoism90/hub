<?php

use App\Web\Auth\Controllers\LoginController;
use App\Web\Auth\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

Route::get('/login', LoginController::class)->middleware('guest')->name('login');
Route::get('/logout', LogoutController::class)->name('logout');
