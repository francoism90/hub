<?php

declare(strict_types=1);

namespace App\Api\Activities\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getRouteKey(),
            'created' => $this->created_at,
            'updated' => $this->updated_at,
        ];
    }
}
