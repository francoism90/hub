<?php

declare(strict_types=1);

namespace Domain\Videos\Concerns;

use Domain\Activities\Models\Activity;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait InteractsWithActivities
{
    public function activities(): MorphMany
    {
        return $this->morphMany(Activity::class, 'model')->chaperone();
    }
}
