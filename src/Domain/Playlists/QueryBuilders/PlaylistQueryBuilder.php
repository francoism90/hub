<?php

namespace Domain\Playlists\QueryBuilders;

use Domain\Playlists\Enums\PlaylistType;
use Domain\Shared\Concerns\InteractsWithScout;
use Illuminate\Database\Eloquent\Builder;

class PlaylistQueryBuilder extends Builder
{
    use InteractsWithScout;

    public function system(): self
    {
        return $this
            ->type(PlaylistType::system());
    }

    public function history(): self
    {
        return $this
            ->where('name', 'history');
    }

    public function watchlist(): self
    {
        return $this
            ->where('name', 'watchlist');
    }
}
