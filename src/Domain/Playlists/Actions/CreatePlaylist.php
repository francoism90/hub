<?php

namespace Domain\Playlists\Actions;

use Domain\Playlists\Models\Playlist;
use Domain\Users\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CreatePlaylist
{
    public function execute(User $user, array $attributes): void
    {
        DB::transaction(function () use ($user, $attributes) {
            $user->playlists()->firstOrCreate(
                Arr::only($attributes, ['name', 'type']),
                Arr::only($attributes, app(Playlist::class)->getFillable()),
            );
        });
    }
}
