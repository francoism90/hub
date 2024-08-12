<?php

namespace Domain\Videos\Concerns;

use Domain\Playlists\Models\Playlist;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait InteractsWithPlaylists
{
    public function playlists(): MorphToMany
    {
        return $this->morphedByMany(Playlist::class, 'videoable');
    }

    public function isFavoritedBy(?User $user = null): bool
    {
        $user ??= auth()->user();

        return $user
            ->playlists()
            ->favorites()
            ->videos()
            ->where('video_id', $this->getKey())
            ->exists();
    }

    public function isWatchlistedBy(?User $user = null): bool
    {
        $user ??= auth()->user();

        return $user
            ->playlists()
            ->watchlist()
            ->videos()
            ->where('video_id', $this->getKey())
            ->exists();
    }

    protected function isFavorited(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->isFavoritedBy()
        )->shouldCache();
    }

    protected function isWatchlisted(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->isWatchlistedBy()
        )->shouldCache();
    }
}
