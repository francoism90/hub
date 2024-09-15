<?php

namespace App\Api\Media\Controllers;

use Domain\Media\Models\Media;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ResponsiveController extends AssetController implements HasMiddleware
{
    public function __invoke(Media $model, Request $request): BinaryFileResponse|StreamedResponse
    {
        Gate::authorize('view', $model);

        return $model->toInlineResponse($request);
    }
}
