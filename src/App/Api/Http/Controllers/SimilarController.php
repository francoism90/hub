<?php

namespace App\Api\Http\Controllers;

use App\Api\Http\Resources\VideoCollection;
use App\Api\Queries\VideoSimilarQuery;
use Domain\Videos\Models\Video;
use Foundation\Http\Controllers\Controller;

class SimilarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function __invoke(VideoSimilarQuery $query, Video $model): VideoCollection
    {
        $this->authorize('view', $model);
        $this->authorize('viewAny', Video::class);

        return new VideoCollection(
            $query->jsonPaginate()
        );
    }
}
