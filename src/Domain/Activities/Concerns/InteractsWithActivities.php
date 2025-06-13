<?php

declare(strict_types=1);

namespace Domain\Activities\Concerns;

use Domain\Activities\Models\Activity;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait InteractsWithActivities
{
    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class)->chaperone();
    }
}
