<?php

declare(strict_types=1);

namespace App\Api\Videos\Controllers;

use App\Api\Videos\Resources\VideoResource;
use Domain\Groups\Actions\MarkAsFavorited;
use Domain\Videos\Models\Video;
use Foundation\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class FavoriteController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum'),
            new Middleware('verified'),
        ];
    }

    public function __invoke(Video $video, Request $request): RedirectResponse|VideoResource
    {
        Gate::authorize('view', $video);

        app(MarkAsFavorited::class)->execute(Auth::user(), $video);

        return $request->inertia()
            ? redirect()->back()
            : VideoResource::make($video);
    }
}
