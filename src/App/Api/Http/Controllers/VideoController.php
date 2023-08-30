<?php

namespace App\Api\Http\Controllers;

use App\Api\Http\Requests\VideoUpdateRequest;
use App\Api\Http\Resources\VideoCollection;
use App\Api\Http\Resources\VideoResource;
use App\Api\Queries\VideoIndexQuery;
use Domain\Videos\Actions\MarkVideoDeleted;
use Domain\Videos\Actions\UpdateVideoDetails;
use Domain\Videos\Models\Video;
use Foundation\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('precognitive')->only(['store', 'update']);

        $this->authorizeResource(Video::class, 'video');
    }

    public function index(VideoIndexQuery $query): VideoCollection
    {
        return new VideoCollection(
            $query->jsonPaginate()
        );
    }

    public function store(Request $request): void
    {
        //
    }

    public function show(Video $model): VideoResource
    {
        return new VideoResource($model
            ->load('media', 'tags')
            ->append(
                'content',
                'summary',
                'snapshot',
                'favorite',
                'following',
                'viewed',
            )
        );
    }

    public function update(Video $model, VideoUpdateRequest $request): JsonResponse
    {
        app(UpdateVideoDetails::class)->execute(
            $model, $request->validated()
        );

        return response()->json(['success' => true]);
    }

    public function destroy(Video $model): JsonResponse
    {
        app(MarkVideoDeleted::class)->execute($model);

        return response()->json(['success' => true]);
    }
}
