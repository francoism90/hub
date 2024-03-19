<?php

namespace Domain\Playlists\QueryBuilders;

use Domain\Playlists\Enums\PlaylistType;
use Domain\Shared\Concerns\InteractsWithScout;
use Illuminate\Database\Eloquent\Builder;

class PlaylistQueryBuilder extends Builder
{
    use InteractsWithScout;

    public function mixer(): self
    {
        return $this
            ->where('type', PlaylistType::Mixer);
    }

    public function system(): self
    {
        return $this
            ->where('type', PlaylistType::System);
    }

    public function favorites(): self
    {
        return $this
            ->system()
            ->where('name', 'favorites');
    }

    public function history(): self
    {
        return $this
            ->system()
            ->where('name', 'history');
    }

    public function watchlist(): self
    {
        return $this
            ->system()
            ->where('name', 'watchlist');
    }
}
