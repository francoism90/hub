<?php

namespace App\Web\Lists\Concerns;

use Domain\Groups\Models\Group;

trait WithGroups
{
    public function bootWithGroups(): void
    {
        $this->authorize('viewAny', Group::class);
    }
}
