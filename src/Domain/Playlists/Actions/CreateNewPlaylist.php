<?php

namespace Domain\Playlists\Actions;

use Domain\Playlists\Models\Playlist;
use Domain\Playlists\States\Verified;
use Domain\Users\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CreateNewPlaylist
{
    public function execute(User $user, array $attributes): Playlist
    {
        return DB::transaction(function () use ($user, $attributes) {
            $model = $user->playlists()->firstOrCreate(
                Arr::only($attributes, ['name', 'type']),
                Arr::only($attributes, app(Playlist::class)->getFillable()),
            );

            if ($model->state->canTransitionTo(Verified::class)) {
                $model->state->transitionTo(Verified::class);
            }

            return $model;
        });
    }
}
