<?php

namespace Domain\Playlists\QueryBuilders;

use Domain\Playlists\Enums\PlaylistType;
use Domain\Playlists\Models\Playlist;
use Domain\Playlists\States\Verified;
use Illuminate\Database\Eloquent\Builder;

class PlaylistQueryBuilder extends Builder
{
    public function published(): self
    {
        return $this
            ->whereState('state', Verified::class);
    }

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

    public function favorites(): ?Playlist
    {
        return $this
            ->system()
            ->firstWhere('name', 'favorites');
    }

    public function history(): ?Playlist
    {
        return $this
            ->system()
            ->firstWhere('name', 'history');
    }

    public function watchlist(): ?Playlist
    {
        return $this
            ->system()
            ->firstWhere('name', 'watchlist');
    }
}
