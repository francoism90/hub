<?php

namespace App\Api\Videos\Controllers;

use Domain\Videos\Actions\GetPreviewManifest;
use Domain\Videos\Actions\GetStreamManifest;
use Domain\Videos\Models\Video;
use Foundation\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class ManifestController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // new Middleware('private'),
            new Middleware('throttle:none'),
            // new Middleware('auth:sanctum'),
            // new Middleware('response_cache:600'),
        ];
    }

    public function __invoke(Video $model, string $type): JsonResponse
    {
        // Gate::authorize('view', $model);

        logger('hit manafest');
        logger($type);

        $foo = response()->json(
            match ($type) {
                'preview' => app(GetPreviewManifest::class)->execute($model),
                default => app(GetStreamManifest::class)->execute($model),
            }
        , 200, [], JSON_UNESCAPED_SLASHES);

        logger($foo);

        return $foo;
    }
}
