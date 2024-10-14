<?php

declare(strict_types=1);

namespace Domain\Activities\Concerns;

use Domain\Activities\Enums\ActivityType;
use Domain\Activities\Models\Activity;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait InteractsWithActivities
{
    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class)->chaperone();
    }

    public function hasFavoritedBy(User $user): bool
    {
        return $this->activities()
            ->where('user_id', $user->getKey())
            ->where('type', ActivityType::Favorite)
            ->exists();
    }
}
