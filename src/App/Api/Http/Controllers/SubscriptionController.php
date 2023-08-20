<?php

namespace App\Api\Http\Controllers;

use Foundation\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'cache:600,vod']);
    }

    public function __invoke(): JsonResponse
    {
        // TODO: check subscription

        return response()->json(['success' => true]);
    }
}
