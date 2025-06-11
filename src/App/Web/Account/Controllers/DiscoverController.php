<?php

declare(strict_types=1);

namespace App\Web\Account\Controllers;

use App\Api\Videos\Resources\VideoCollection;
use App\Web\Account\Scopes\DiscoverScope;
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

class DiscoverController extends Controller implements HasMiddleware
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

        return Inertia::render('Account/DiscoverIndex', [
            'tab' => fn () => $request->query('tab', 'discover'),
            'items' => Inertia::defer(fn () => $this->getCollection($request))->deepMerge(),
        ]);
    }

    protected function getCollection(Request $request): VideoCollection
    {
        return VideoCollection::make($this
            ->getBuilder($request)
            ->simplePaginate(perPage: 16, page: $request->input('page', 1))
        );
    }

    protected function getBuilder(Request $request): Builder
    {
        return Video::query()->tap(new DiscoverScope(
            user: $request->user(),
        ));
    }
}
