<?php

declare(strict_types=1);

namespace App\Api\Videos\Resources;

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
            'content' => $this->content,
            'summary' => $this->summary,
            'season' => $this->season,
            'episode' => $this->episode,
            'part' => $this->part,
            'adult' => $this->adult,
            'duration' => $this->duration,
            'thumbnail' => $this->thumbnail,
            'srcset' => $this->srcset,
            'state' => $this->state,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'links' => $this->links(),
            // 'routes' => $this->when($request->routeIs('dashboard.*'), $this->routes()),
            // 'playlists' => PlaylistCollection::make($this->whenLoaded('playlists')),
            'user' => UserResource::make($this->whenLoaded('user')),
        ];
    }

    public function links(): array
    {
        return [
            // 'update' => route('api.videos.update', $this),
            // 'destroy' => route('api.videos.destroy', $this),
        ];
    }

    public function routes(): array
    {
        return [
            'index' => inertia_route('videos.index'),
            'show' => inertia_route('videos.show', $this),
        ];
    }
}
