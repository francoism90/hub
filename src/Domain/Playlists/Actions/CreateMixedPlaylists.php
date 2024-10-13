<?php

namespace Domain\Playlists\Actions;

use Domain\Playlists\Enums\PlaylistMixer;
use Domain\Playlists\Enums\PlaylistType;
use Domain\Users\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CreateMixedPlaylists
{
    public function execute(User $user): Collection
    {
        return DB::transaction(function () use ($user) {
            $mixers = PlaylistMixer::cases();

            $items = collect();

            foreach ($mixers as $mixer) {
                $model = app(CreateNewPlaylist::class)->execute($user, [
                    'name' => $mixer->value,
                    'type' => PlaylistType::Mixer,
                ]);

                $items->push($model);
            }

            return $items;
        });
    }
}
