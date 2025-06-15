<?php

declare(strict_types=1);

namespace App\Api\Videos\Resources;

use App\Api\Tags\Resources\TagCollection;
use App\Api\Users\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    /**
     * @var bool
     */
    public $preserveKeys = true;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getRouteKey(),
            'name' => $this->name,
            'titles' => $this->titles,
            'summary' => $this->summary,
            'season' => $this->season,
            'episode' => $this->episode,
            'part' => $this->part,
            'adult' => $this->adult,
            'duration' => $this->duration,
            'timestamp' => $this->timestamp,
            'thumbnail' => $this->thumbnail,
            'srcset' => $this->srcset,
            'manifest' => $this->manifest,
            'preview' => $this->preview,
            'published' => $this->published,
            'released' => $this->released_at,
            'created' => $this->created_at,
            'updated' => $this->updated_at,
            'state' => $this->state,
            'tags' => TagCollection::make($this->tags),
            'user' => UserResource::make($this->whenLoaded('user')),
        ];
    }
}
