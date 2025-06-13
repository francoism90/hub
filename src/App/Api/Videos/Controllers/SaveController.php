<?php

declare(strict_types=1);

namespace App\Api\Videos\Controllers;

use App\Api\Videos\Resources\VideoResource;
use Domain\Groups\Actions\MarkAsSaved;
use Domain\Videos\Models\Video;
use Foundation\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SaveController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum'),
            new Middleware('verified'),
        ];
    }

    public function __invoke(Video $video): VideoResource
    {
        Gate::authorize('view', $video);

        app(MarkAsSaved::class)->execute(Auth::user(), $video);

        return VideoResource::make($video);
    }
}
