<?php

namespace Domain\Playlists\Actions;

use Domain\Playlists\Enums\PlaylistType;
use Domain\Playlists\States\Verified;
use Domain\Users\Models\User;

class InitializePlaylists
{
    public function execute(User $user): void
    {
        $items = collect([
            ['name' => 'favorites', 'type' => PlaylistType::System],
            ['name' => 'history', 'type' => PlaylistType::System],
            ['name' => 'watchlist', 'type' => PlaylistType::System],
        ]);

        $items->each(function (array $item) use ($user) {
            $playlist = app(CreatePlaylist::class)->execute($user, $item);

            if ($playlist->state->canTransitionTo(Verified::class)) {
                $playlist->state->transitionTo(Verified::class);
            }
        });
    }
}
