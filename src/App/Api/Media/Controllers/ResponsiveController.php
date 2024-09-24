<?php

namespace App\Api\Media\Controllers;

use Domain\Media\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ResponsiveController extends AssetController
{
    public function __invoke(Media $media, Request $request): BinaryFileResponse|StreamedResponse
    {
        Gate::authorize('view', $media);

        return $media->toInlineResponse($request);
    }
}
