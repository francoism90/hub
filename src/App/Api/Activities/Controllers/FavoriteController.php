<?php

declare(strict_types=1);

namespace App\Api\Authentication\Controllers;

use App\Api\Activities\Requests\FavoriteRequest;
use App\Api\Activities\Resources\ActivityResource;
use Foundation\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class FavoriteController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum'),
        ];
    }

    public function __invoke(Model $model, FavoriteRequest $request): ActivityResource
    {
        Gate::authorize('view', $model);

        return ActivityResource::make($activity);
    }
}
