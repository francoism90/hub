<?php

namespace App\Api\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getRouteKey(),
            'slug' => $this->slug,
            'name' => $this->name,
            'season' => $this->season,
            'episode' => $this->episode,
            'adult' => $this->adult,
            'captions' => $this->closed_captions,
            'duration' => $this->duration,
            'preview' => $this->preview,
            'stream' => $this->stream,
            'placeholder' => $this->placeholder,
            'thumbnail' => $this->thumbnail,
            'state' => $this->whenAppended('state'),
            'summary' => $this->whenAppended('summary'),
            'content' => $this->whenAppended('content'),
            'snapshot' => $this->whenAppended('snapshot'),
            'favorite' => $this->whenAppended('favorite', $this->favorite()),
            'following' => $this->whenAppended('following', $this->following()),
            'viewed' => $this->whenAppended('viewed', $this->viewed()),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'user' => new UserResource($this->whenLoaded('user')),
            'released_at' => $this->released_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    protected function favorite(): bool
    {
        return $this->isFavoritedBy(
            auth()->user()
        );
    }

    protected function following(): bool
    {
        return $this->isFollowedBy(
            auth()->user()
        );
    }

    protected function viewed(): bool
    {
        return $this->isViewedBy(
            auth()->user()
        );
    }
}
