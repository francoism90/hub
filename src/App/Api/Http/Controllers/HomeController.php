<?php

namespace App\Api\Http\Controllers;

use Foundation\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class HomeController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('signed'),
            new Middleware('response_cache:900'),
        ];
    }

    public function __invoke(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => __('Welcome to the API.'),
        ]);
    }
}
