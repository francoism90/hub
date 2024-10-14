<?php

declare(strict_types=1);

namespace Domain\Videos\Concerns;

use Domain\Groups\Models\Group;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait InteractsWithGroups
{
    public function groups(): MorphToMany
    {
        return $this->morphedByMany(Group::class, 'videoable')->chaperone();
    }
}
