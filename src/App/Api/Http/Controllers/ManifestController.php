<?php

namespace App\Api\Http\Controllers;

use Domain\Videos\Actions\GetPreviewManifest;
use Domain\Videos\Actions\GetStreamManifest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Domain\Videos\Models\Video;
use Foundation\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class ManifestController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('private'),
            new Middleware('auth:sanctum'),
            new Middleware('cache:600,vod'),
        ];
    }

    public function __invoke(Video $model, string $type): JsonResponse
    {
        Gate::authorize('view', $model);

        return response()->json(
            match ($type) {
                'preview' => app(GetPreviewManifest::class)->execute($model),
                default => app(GetStreamManifest::class)->execute($model),
            }
        );
    }
}
