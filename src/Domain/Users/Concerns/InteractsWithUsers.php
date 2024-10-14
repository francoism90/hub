<?php

declare(strict_types=1);

namespace Domain\Users\Concerns;

use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait InteractsWithUsers
{
    public function users(): MorphToMany
    {
        return $this->morphToMany(User::class, 'userable');
    }
}
