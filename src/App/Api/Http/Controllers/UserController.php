<?php

namespace App\Api\Http\Controllers;

use App\Api\Http\Resources\UserCollection;
use App\Api\Http\Resources\UserResource;
use Domain\Users\Models\User;
use Domain\Users\QueryBuilders\UserIndexQuery;
use Foundation\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('precognitive')->only(['store', 'update']);

        $this->authorizeResource(User::class, 'user');
    }

    public function index(UserIndexQuery $query): UserCollection
    {
        return new UserCollection(
            $query->jsonPaginate()
        );
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
