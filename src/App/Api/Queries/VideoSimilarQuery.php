<?php

namespace App\Api\Queries;

use Domain\Videos\Models\Video;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class VideoSimilarQuery extends QueryBuilder
{
    public function __construct(Request $request)
    {
        $query = Video::query()
            ->similar($request->video)
            ->with([
                'favoriters',
                'followers',
                'tags',
                'views',
            ]);

        parent::__construct($query, $request);
    }
}
