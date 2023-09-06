<?php

namespace App\Api\Http\Controllers;

use Domain\Media\Models\Media;
use Foundation\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth.session', 'private']);
    }

    public function __invoke(Media $media): BinaryFileResponse
    {
        return response()->download($media->getPath(), $media->file_name);
    }
}
