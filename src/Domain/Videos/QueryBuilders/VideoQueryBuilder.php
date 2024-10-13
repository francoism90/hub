<?php

namespace Domain\Videos\QueryBuilders;

use Domain\Users\Models\User;
use Domain\Videos\States\Verified;
use Illuminate\Database\Eloquent\Builder;

class VideoQueryBuilder extends Builder
{
    public function published(): self
    {
        return $this->whereState('state', Verified::class);
    }

    public function recent(): self
    {
        return $this
            ->orderByDesc('created_at')
            ->orderByDesc('released_at');
    }

    public function daily(): self
    {
        return $this
            ->inRandomOrder()
            ->take(48);
    }

    public function discoverable(?User $user = null): self
    {
        return $this->daily();

        // $user ??= auth()->user();

        // return $this->whereDoesntHave('playlists.videos', fn (Builder $query) => $query
        //     ->where('playlists.user_id', $user->getKey())
        // );
    }
}
