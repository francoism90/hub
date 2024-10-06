<?php

namespace App\Api\Videos\Controllers;

use App\Api\Videos\Request\HistoryRequest;
use App\Api\Videos\Resources\VideoResource;
use Domain\Playlists\Actions\SyncVideoTimeCode;
use Domain\Videos\Models\Video;
use Foundation\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class HistoryController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum'),
        ];
    }

    public function __invoke(Video $video, HistoryRequest $request): VideoResource
    {
        Gate::authorize('view', $video);

        app(SyncVideoTimeCode::class)->execute(
            $request->user(), $video, $request->float('time')
        );

        return new VideoResource($video);
    }
}
