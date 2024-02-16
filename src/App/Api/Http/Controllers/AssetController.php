<?php

namespace App\Api\Http\Controllers;

use Domain\Media\Models\Media;
use Foundation\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AssetController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'signed',
            'cache.headers:public;max_age=604800;etag',
        ]);
    }

    public function __invoke(Media $media, Request $request): BinaryFileResponse|StreamedResponse
    {
        $this->authorize('view', $media);

        if (in_array($media->collection_name, ['clips', 'previews'])) {
            return response()->download($media->getPath());
        }

        return $media->toResponse($request);
    }
}
