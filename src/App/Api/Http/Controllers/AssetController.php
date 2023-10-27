<?php

namespace App\Api\Http\Controllers;

use Domain\Media\Models\Media;
use Foundation\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AssetController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'signed',
            'cache.headers:public;max_age=86400;etag',
        ]);
    }

    public function __invoke(Media $media, Request $request): StreamedResponse
    {
        $this->authorize('view', $media);

        return $media->toResponse($request);
    }
}
