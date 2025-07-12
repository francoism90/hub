<?php

declare(strict_types=1);

namespace App\Web\Videos\Controllers;

use App\Api\Playlists\Resources\PlaylistCollection;
use App\Api\Videos\Resources\VideoResource;
use Domain\Videos\Jobs\PlaylistVideo;
use Domain\Videos\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class VideoController implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('verified'),
        ];
    }

    public function index(Request $request)
    {
        //
    }

    public function create()
    {
        // Gate::authorize('create', Video::class);

        // return Inertia::render('Videos/VideoCreate', [
        //     //
        // ]);
    }

    public function show(Video $video): Response
    {
        Gate::authorize('view', $video);

        PlaylistVideo::dispatch($video);

        return Inertia::render('Videos/VideoView', [
            'item' => fn () => VideoResource::make($video),
            'assets' => fn () => PlaylistCollection::make($video->playlists),
        ]);
    }

    public function edit(Video $video)
    {
        //
    }
}
