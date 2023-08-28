<?php

namespace Foundation\Http\Middlewares;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson()
            ? route('auth.login')
            : route('filament.admin.auth.login');
    }
}
