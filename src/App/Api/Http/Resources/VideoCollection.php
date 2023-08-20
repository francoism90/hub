<?php

namespace App\Api\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VideoCollection extends ResourceCollection
{
    /**
     * @var string
     */
    public $collects = VideoResource::class;

    /**
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->collection->each->append(
            'favorited',
            'following',
            'viewed',
        );

        return parent::toArray($request);
    }
}
