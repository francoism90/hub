<?php

namespace Domain\Videos\Concerns;

use Domain\Videos\Models\Relatable;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasRelated
{
    public function relatables(): MorphMany
    {
        return $this->morphMany(Relatable::class, 'model');
    }
}
