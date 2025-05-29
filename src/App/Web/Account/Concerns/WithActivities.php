<?php

declare(strict_types=1);

namespace App\Web\Account\Concerns;

use Domain\Activities\Models\Activity;

trait WithActivities
{
    public function bootWithActivities(): void
    {
        $this->authorize('viewAny', Activity::class);
    }
}
