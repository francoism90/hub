<?php

namespace App\Api\Http\Controllers;

use Domain\Media\Models\Media;
use Foundation\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Filesystem;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ResponsiveController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'auth:sanctum',
            'cache.headers:public;max_age=86400;etag',
        ]);
    }

    public function __invoke(Media $model, ?string $conversion = null): StreamedResponse
    {
        $this->authorize('view', $model);

        abort_if(! $conversion || ! $model->hasResponsiveImages(), 404);

        $directory = app(Filesystem::class)->getResponsiveImagesDirectory($model);

        return Storage::disk($model->disk)->response(
            implode('', [$directory, $conversion])
        );
    }
}
