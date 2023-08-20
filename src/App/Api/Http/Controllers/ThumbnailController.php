<?php

namespace App\Api\Http\Controllers;

use Foundation\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ThumbnailController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'cache.headers']);
    }

    public function __invoke(Model $model, Request $request): StreamedResponse
    {
        $this->authorize('view', $model);

        abort_if(! $model->hasMedia('thumbnail'), 404);

        return $model
            ->getFirstMedia('thumbnail')
            ->toInlineResponse($request);
    }
}
