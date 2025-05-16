<?php

declare(strict_types=1);

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
            // new Middleware('throttle:none'),
            // new Middleware('cache_model:600,video'),
        ];
    }

    public function __invoke(Video $model, string $format): JsonResponse
    {
        // Gate::authorize('view', $model);

        logger($format);

        $manifest = app(GetStreamManifest::class)->execute($model, $format);

        logger($manifest);

        return response()->json(data: $manifest, options: JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
}
