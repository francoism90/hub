<?php

namespace App\Api\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getRouteKey(),
            'name' => $this->name,
            'type' => $this->type,
            'adult' => $this->adult,
            'created_at' => $this->whenAppended($this->created_at),
            'updated_at' => $this->whenAppended($this->updated_at),
        ];
    }
}
