<?php

declare(strict_types=1);

namespace App\Api\Videos\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->getRouteKey(),
            'name' => 'name',
            'summary' => 'summary',
            'season' => 'season',
            'episode' => 'episode',
            'part' => 'part',
            'thumbnail' => $this->thumbnail,
            'srcset' => $this->srcset,
            'duration' => $this->duration,
            'adult' => $this->adult,
            'content' => $this->whenAppended('content'),
            'titles' => $this->whenAppended('titles'),
            'expires' => $this->expires_at,
            'published' => $this->published_at,
            'created' => $this->created_at,
            'updated' => $this->updated_at,
        ];
    }
}
