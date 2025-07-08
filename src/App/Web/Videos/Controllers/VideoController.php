<?php

declare(strict_types=1);

namespace App\Web\Videos\Controllers;

use Domain\Videos\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

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

    public function show(Video $video)
    {
        Gate::authorize('view', $video);

        return Inertia::render('Videos/VideoView', [
            'item' => $video,
            // 'items' => $video->comments,
            // 'tab' => $request->get('tab', 'comments'),
        ]);
    }

    public function edit(Video $video)
    {
        //
    }
}
