<?php

declare(strict_types=1);

namespace Domain\Activities\Concerns;

use Domain\Activities\Models\Activity;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasActivities
{
    public function activities(): MorphMany
    {
        return $this->morphMany(Activity::class, 'model')->chaperone();
    }
}
