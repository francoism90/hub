<?php

declare(strict_types=1);

namespace Domain\Activities\Concerns;

use Domain\Activities\Enums\ActivityType;
use Domain\Activities\Models\Activity;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Builder;

trait HasActivities
{
    public function activities(): MorphMany
    {
        return $this->morphMany(Activity::class, 'model')->chaperone();
    }

    public function findActivity(User $user, ?ActivityType $type = null): ?Activity
    {
        return $this->query()
            ->withActivities($user, $type)
            ->first();
    }

    public function hasActivity(User $user, ?ActivityType $type = null): bool
    {
        return $this->query()
            ->withActivities($user, $type)
            ->exists();
    }

    public function removeActivity(User $user, ?ActivityType $type = null): ?bool
    {
        return $this->findActivity($user, $type)?->delete();
    }

    public function scopeWithActivities(
        Builder $query,
        User $user,
        ?ActivityType $type = null,
    ): Builder {
        return $this
            ->activities()
            ->where('user_id', $user->getKey())
            ->when($type, fn ($query) => $query->where('type', $type));
    }
}
