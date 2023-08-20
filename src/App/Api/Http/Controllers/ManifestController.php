<?php

namespace App\Api\Http\Controllers;

use Domain\Videos\Actions\GetPreviewManifest;
use Domain\Videos\Actions\GetStreamManifest;
use Domain\Videos\Models\Video;
use Foundation\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ManifestController extends Controller
{
    public function __construct()
    {
        $this->middleware(['private', 'auth:sanctum', 'cache:600,vod']);
    }

    public function __invoke(Video $model, string $type): JsonResponse
    {
        $this->authorize('view', $model);

        return response()->json(
            match ($type) {
                'preview' => app(GetPreviewManifest::class)->execute($model),
                default => app(GetStreamManifest::class)->execute($model),
            }
        );
    }
}
