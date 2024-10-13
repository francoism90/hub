<?php

namespace Domain\Playlists\QueryBuilders;

use Domain\Playlists\Enums\PlaylistType;
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

    public function personal(): self
    {
        return $this
            ->whereIn('type', [PlaylistType::Private, PlaylistType::Public]);
    }
}
