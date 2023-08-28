<?php

namespace Domain\Playlists\QueryBuilders;

use Domain\Playlists\Enums\PlaylistType;
use Domain\Shared\Concerns\InteractsWithScout;
use Illuminate\Database\Eloquent\Builder;

class PlaylistQueryBuilder extends Builder
{
    use InteractsWithScout;

    public function listable(): self
    {
        return $this
            ->whereNot('type', PlaylistType::system());
    }

    public function type(PlaylistType|string $type): self
    {
        if (is_string($type)) {
            $type = PlaylistType::tryFrom($type);
        }

        return $this
            ->when(filled($type), fn (Builder $query) => $query->where('type', $type));
    }
}
