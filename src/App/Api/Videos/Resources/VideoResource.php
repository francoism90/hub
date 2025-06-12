<?php

declare(strict_types=1);

namespace App\Api\Videos\Resources;

use App\Api\Tags\Resources\TagCollection;
use App\Api\Users\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    /**
     * @var bool
     */
    public $preserveKeys = true;

    public function toArray($request): array
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
            'thumbnail' => $this->thumbnail,
            'srcset' => $this->srcset,
            'manifest' => $this->manifest,
            'preview' => $this->preview,
            'duration' => $this->duration,
            'timestamp' => $this->timestamp,
            'state' => $this->state,
            'created' => $this->created_at,
            'created_human' => $this->created_at->diffForHumans(),
            'updated' => $this->updated_at,
            'updated_human' => $this->updated_at->diffForHumans(),
            'tags' => TagCollection::make($this->whenLoaded('tags')),
            'user' => UserResource::make($this->whenLoaded('user')),
        ];
    }
}
