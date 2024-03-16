<?php

namespace App\Api\Http\Controllers;

use Foundation\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => __('Welcome to the API.'),
        ]);
    }
}
