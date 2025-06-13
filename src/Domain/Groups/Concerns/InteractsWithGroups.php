<?php

declare(strict_types=1);

namespace Domain\Groups\Concerns;

use Domain\Groups\Models\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait InteractsWithGroups
{
    public function groups(): HasMany
    {
        return $this->hasMany(Group::class)->chaperone();
    }

    public function hasFavorited(Model $model): bool
    {
        return $model->groups()
            ->favorites()
            ->where('user_id', $this->getKey())
            ->exists();
    }

    public function hasSaved(Model $model): bool
    {
        return $model->groups()
            ->saves()
            ->where('user_id', $this->getKey())
            ->exists();
    }

    public function hasViewed(Model $model): bool
    {
        return $model->groups()
            ->saves()
            ->where('user_id', $this->getKey())
            ->exists();
    }
}
