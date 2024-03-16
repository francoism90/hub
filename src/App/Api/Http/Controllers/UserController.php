<?php

namespace App\Api\Http\Controllers;

use App\Api\Http\Resources\UserResource;
use Domain\Users\Models\User;
use Foundation\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Http\Request;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum'),
            new Middleware('precognitive', only: ['store', 'update']),
        ];
    }

    public function index(Request $request)
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $model): UserResource
    {
        return new UserResource($model);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
