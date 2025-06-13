<?php

declare(strict_types=1);

namespace App\Api\Groups\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->getRouteKey(),
            'name' => $this->name,
            'content' => $this->content,
            'created' => $this->created_at,
            'updated' => $this->updated_at,
        ];
    }
}
