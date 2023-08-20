<?php

use App\Api\Http\Controllers\AuthenticateController;
use Illuminate\Support\Facades\Route;

Route::name('auth.')->prefix('v1')->group(function () {
    $limiter = config('fortify.limiters.login');

    Route::controller(AuthenticateController::class)->group(function () use ($limiter) {
        Route::post('/login', 'store')
            ->name('login')
            ->middleware(array_filter([
                'guest',
                $limiter ? 'throttle:'.$limiter : null,
            ]));

        Route::post('/logout', 'destroy')
            ->name('logout')
            ->middleware('auth:sanctum');

        Route::get('/user', 'show')
            ->name('user')
            ->middleware('auth:sanctum');
    });
});
