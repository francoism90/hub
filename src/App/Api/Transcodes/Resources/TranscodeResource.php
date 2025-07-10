<?php

declare(strict_types=1);

namespace App\Api\Transcodes\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TranscodeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->getRouteKey(),
            'created' => $this->created_at,
            'updated' => $this->updated_at,
        ];
    }
}
