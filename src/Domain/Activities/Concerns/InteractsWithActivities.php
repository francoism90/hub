<?php

declare(strict_types=1);

namespace Domain\Activities\Concerns;

use Domain\Activities\Enums\ActivityType;
use Domain\Activities\Models\Activity;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait InteractsWithActivities
{
    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class)->chaperone();
    }

    public function getActivity(mixed $model = null, ?ActivityType $type = null): ?Activity
    {
        return $this->getActivities($model, $type)->first();
    }

    public function hasActivity(mixed $model = null, ?ActivityType $type = null): bool
    {
        return $this->getActivities($model, $type)->exists();
    }

    public function getActivities(mixed $model = null, ?ActivityType $type = null): HasMany
    {
        return $this->activities()
            ->when($model, fn ($query) => $query->whereMorph('model', $model))
            ->when($type, fn ($query) => $query->where('type', $type))
            ->latest();
    }
}
