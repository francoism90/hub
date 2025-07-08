<?php

declare(strict_types=1);

namespace App\Api\Videos\Controllers;

use Domain\Videos\Actions\GetPreviewManifest;
use Domain\Videos\Actions\GetVideoManifest;
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
            new Middleware('private'),
            new Middleware('throttle:none'),
            new Middleware('cache_response:600,video'),
        ];
    }

    public function __invoke(Video $model, string $type, string $format): JsonResponse
    {
        Gate::authorize('view', $model);

        return response()->json(match ($type) {
            'preview' => app(GetPreviewManifest::class)->execute($model),
            default => app(GetVideoManifest::class)->execute($model),
        }, 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
}
