<?php

namespace Domain\Playlists\QueryBuilders;

use Domain\Playlists\Enums\PlaylistType;
use Domain\Shared\Concerns\InteractsWithScout;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Builder;

class PlaylistQueryBuilder extends Builder
{
    use InteractsWithScout;

    public function history(User $user = null): self
    {
        /** @var User $user */
        $user ??= auth()->user();

        return $this
            ->where('user_id', $user->getKey())
            ->where('name', 'history')
            ->type(PlaylistType::system());
    }

    public function listable(): self
    {
        return $this
            ->whereNot('type', PlaylistType::system());
    }

    public function type(PlaylistType|string $type): self
    {
        if (is_string($type)) {
            $type = PlaylistType::tryFrom($type);
        }

        return $this
            ->when(filled($type), fn (Builder $query) => $query->where('type', $type));
    }
}
