<?php

declare(strict_types=1);

namespace App\Api\Transcodes\Controllers;

use Domain\Transcodes\Exceptions\ExpiredTranscodeException;
use Domain\Transcodes\Models\Transcode;
use Foundation\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Gate;
use League\Flysystem\WhitespacePathNormalizer;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TranscodeMediaController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // new Middleware('auth:sanctum'),
            // new Middleware('cache:public;max_age=604800;immutable'),
        ];
    }

    public function __invoke(Transcode $transcode, string $path): StreamedResponse
    {
        Gate::authorize('view', [$transcode->getModel(), $transcode]);

        throw_if($transcode->isExpired(), ExpiredTranscodeException::make());

        // Sanitize the path to prevent directory traversal attacks
        $path = (new WhitespacePathNormalizer())->normalizePath($path);

        return $transcode->toResponse($path);
    }
}
