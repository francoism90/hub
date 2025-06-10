<?php

declare(strict_types=1);

namespace App\Web\Videos\Controllers;

use App\Api\Videos\Resources\VideoCollection;
use App\Web\Videos\Scopes\VideoListScope;
use Domain\Videos\Models\Video;
use Foundation\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class VideoIndexController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('verified'),
        ];
    }

    public function __invoke(Request $request): Response
    {
        Gate::authorize('viewAny', Video::class);

        return Inertia::render('Videos/VideoIndex', [
            'videos' => fn () => VideoCollection::make(
                $this->getBuilder($request)->simplePaginate(16)
            ),
        ]);
    }

    protected function getBuilder(Request $request): Builder
    {
        return Video::query()->tap(new VideoListScope(
            user: $request->user(),
        ));
    }
}
