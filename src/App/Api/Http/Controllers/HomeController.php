<?php

namespace App\Api\Http\Controllers;

use Foundation\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('cache:600,api'),
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
