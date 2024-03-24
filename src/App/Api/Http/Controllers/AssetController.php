<?php

namespace App\Api\Http\Controllers;

use Domain\Media\Models\Media;
use Foundation\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AssetController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('signed'),
            new Middleware('cacheable:public;max_age=604800;etag'),
        ];
    }

    public function __invoke(Media $media, Request $request): BinaryFileResponse|StreamedResponse
    {
        Gate::authorize('view', $media);

        return $media->toResponse($request);
    }
}
