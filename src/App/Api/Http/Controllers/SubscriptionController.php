<?php

namespace App\Api\Http\Controllers;

use Foundation\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SubscriptionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum'),
            new Middleware('response_cache:600,user-'.auth()->id()),
        ];
    }

    public function __invoke(): JsonResponse
    {
        // TODO: actually check subscription

        return response()->json(['success' => true]);
    }
}
