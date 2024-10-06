<?php

namespace App\Api\Users\Controllers;

use App\Api\Users\Resources\UserResource;
use Foundation\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class SubscriptionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('private'),
            new Middleware('throttle:none'),
            new Middleware('auth:sanctum'),
            new Middleware('response_cache:600,user-'.auth()->id()),
        ];
    }

    public function __invoke(Request $request): UserResource
    {
        logger($request->headers->all());
        Gate::authorize('update', $request->user());

        return new UserResource($request->user());
    }
}
