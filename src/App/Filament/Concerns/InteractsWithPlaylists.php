<?php

namespace App\Filament\Concerns;

use Domain\Playlists\Models\Playlist;
use Domain\Users\Models\User;

trait InteractsWithPlaylists
{
    protected static function history(User $user = null): ?Playlist
    {
        /** @var User */
        $user ??= auth()->user();

        return $user
            ->playlists()
            ->history()
            ->first();
    }
}
