<?php

namespace App\Api\Videos\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->getRouteKey(),
            'name' => $this->whenAppended('name'),
            'summary' => $this->whenAppended('summary'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
