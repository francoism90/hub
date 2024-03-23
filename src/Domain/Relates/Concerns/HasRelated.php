<?php

namespace Domain\Relates\Concerns;

use Domain\Relates\Models\Relatable;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasRelated
{
    public function relatables(): MorphMany
    {
        return $this->morphMany(Relatable::class, 'model');
    }
}
