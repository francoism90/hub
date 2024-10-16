<?php

declare(strict_types=1);

namespace Domain\Videos\Concerns;

use Domain\Groups\Models\Group;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait InteractsWithGroups
{
    public function groups(): MorphToMany
    {
        return $this->morphedByMany(Group::class, 'videoable');
    }

    public function isFavoritedBy(?User $user = null): bool
    {
        $user ??= auth()->user();

        $group = $user->groups()->favorites();

        return $group instanceof Group && $group
            ->videos()
            ->where('video_id', $this->getKey())
            ->exists();
    }

    public function isSavedBy(?User $user = null): bool
    {
        $user ??= auth()->user();

        $group = $user->groups()->saved();

        return $group instanceof Group && $group
            ->videos()
            ->where('video_id', $this->getKey())
            ->exists();
    }

    public function isViewedBy(?User $user = null): bool
    {
        $user ??= auth()->user();

        $group = $user->groups()->viewed();

        return $group instanceof Group && $group
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

    protected function isSaved(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->isSavedBy()
        )->shouldCache();
    }
}
