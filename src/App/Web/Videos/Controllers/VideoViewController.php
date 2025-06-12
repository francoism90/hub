<?php

declare(strict_types=1);

namespace App\Web\Videos\Controllers;

use App\Api\Videos\Resources\VideoResource;
use Domain\Videos\Models\Video;
use Foundation\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;
use App\Api\Videos\Resources\VideoCollection;
use App\Web\Account\Scopes\DiscoverScope;
use Domain\Videos\Algos\GenerateVideoSuggestions;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class VideoViewController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('verified'),
        ];
    }

    public function __invoke(Video $video, Request $request): Response
    {
        Gate::authorize('view', $video);

        return Inertia::render('Videos/VideoView', [
            'item' => fn () => VideoResource::make($video->load(['media', 'tags'])),
            'items' => Inertia::defer(fn () => $this->getCollection($video, $request))->deepMerge(),
        ]);
    }

    protected function getCollection(Video $video, Request $request): Paginator
    {
        Gate::authorize('viewAny', Video::class);

        $algo = GenerateVideoSuggestions::make()
            ->forEntity($video)
            ->limit(16)
            ->run();

        return VideoCollection::make($algo->get('items'))->simplePaginate(
            perPage: 16,
            page: $request->input('page', 1)
        );
    }
}
