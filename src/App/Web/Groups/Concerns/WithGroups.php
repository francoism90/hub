<?php

declare(strict_types=1);

namespace App\Web\Groups\Concerns;

use Domain\Groups\Models\Group;

trait WithGroups
{
    public function bootWithGroups(): void
    {
        $this->authorize('viewAny', Group::class);
    }
}
