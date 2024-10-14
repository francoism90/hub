<?php

namespace Domain\Groups\Concerns;

use Domain\Groups\Models\Group;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait InteractsWithGroups
{
    public function groups(): HasMany
    {
        return $this->hasMany(Group::class)->chaperone();
    }
}
