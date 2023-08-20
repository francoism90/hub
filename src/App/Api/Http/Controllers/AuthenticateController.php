<?php

namespace App\Api\Http\Controllers;

use App\Api\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

class AuthenticateController extends AuthenticatedSessionController
{
    public function __construct()
    {
        $this->middleware('cache:600,auth')->only('show');
        $this->middleware('precognitive')->only('store');
    }

    public function show(Request $request): UserResource
    {
        return new UserResource($request->user()
            ->load('roles', 'permissions')
            ->append(
                'name',
                'email',
                'roles',
                'permissions'
            )
        );
    }

    public function destroy(Request $request): LogoutResponse
    {
        auth()->guard('web')->logout();

        if (method_exists($request->user()->currentAccessToken(), 'delete')) {
            $request->user()->currentAccessToken()->delete();
        }

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return app(LogoutResponse::class);
    }
}
