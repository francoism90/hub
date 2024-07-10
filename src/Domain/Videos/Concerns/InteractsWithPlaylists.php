<?php

namespace Domain\Videos\Concerns;

use Domain\Playlists\Models\Playlist;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait InteractsWithPlaylists
{
    public function playlists(): MorphToMany
    {
        return $this->morphedByMany(Playlist::class, 'videoable');
    }

    public function markWatched(User $user, ?float $time = null): void
    {
        throw_unless(! $time || ($time >= 0 && $time <= ceil($this->duration)));

        cache()->remember(static::getWatchedKey($user), now()->addSeconds(10), function () use ($user, $time) {
            $this->attachVideoHistory($user, $time);

            return time();
        });
    }

    protected function attachVideoHistory(User $user, float $time = 0): void
    {
        $this->playlists()
            ->history()
            ->firstWhere('user_id', $user->getKey())
            ->attachVideo($this, [
                'timestamp' => round($time, 2),
            ]);
    }

    protected static function getWatchedKey(User $user): string
    {
        return sprintf('videoWatched-%s', $user->getKey());
    }
}
