<?php

namespace App\Api\Media\Controllers;

use Domain\Media\Models\Media;
use Foundation\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Filesystem;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ResponsiveController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum'),
            new Middleware('cache.headers:public;max_age=604800;etag'),
        ];
    }

    public function __invoke(Media $model, ?string $conversion = null): StreamedResponse
    {
        Gate::authorize('view', $model);

        abort_if(! $conversion || ! $model->hasResponsiveImages(), 404);

        $directory = app(Filesystem::class)->getResponsiveImagesDirectory($model);

        return Storage::disk($model->disk)->response(
            implode('', [$directory, $conversion])
        );
    }
}
