<?php

namespace Domain\Playlists\Actions;

use Domain\Playlists\Enums\PlaylistMixers;
use Domain\Users\Models\User;

class CreateMixedPlaylists
{
    public function execute(User $user): void
    {
        $mixers = PlaylistMixers::cases();

        foreach ($mixers as $mixer) {
            app(CreateNewPlaylist::class)->execute($user, [
                'name' => $mixer->label(),
                'type' => $mixer->value,
            ]);
        }
    }
}
