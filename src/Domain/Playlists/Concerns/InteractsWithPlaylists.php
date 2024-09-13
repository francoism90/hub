<?php

namespace Domain\Playlists\Concerns;

use Domain\Playlists\Models\Playlist;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait InteractsWithPlaylists
{
    public function playlists(): HasMany
    {
        return $this->hasMany(Playlist::class)->chaperone();
    }
}
