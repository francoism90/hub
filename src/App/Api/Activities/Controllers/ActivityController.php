<?php

declare(strict_types=1);

namespace App\Api\Activities\Controllers;

use App\Api\Activities\Requests\ActivityRequest;
use App\Api\Activities\Requests\FavoriteRequest;
use App\Api\Activities\Resources\ActivityResource;
use Domain\Activities\Actions\CreateNewActivity;
use Domain\Activities\Actions\ToggleActivity;
use Foundation\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Spatie\PrefixedIds\PrefixedIds;

class ActivityController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum'),
        ];
    }

    public function __invoke(ActivityRequest $request): JsonResponse
    {
        $validated = $request->safe()->all();

        $model = PrefixedIds::findOrFail($validated['model']);

        Gate::authorize('view', $model);

        app(ToggleActivity::class)->handle(Auth::user(), $model, $validated['type']);

        return response()->json();
    }
}
