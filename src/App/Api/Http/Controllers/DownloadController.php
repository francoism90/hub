<?php

namespace App\Api\Http\Controllers;

use Domain\Media\Models\Media;
use Foundation\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth.session', 'private']);
    }

    public function __invoke(Media $media, Request $request): StreamedResponse
    {
        return $media->toInlineResponse($request);
    }
}
