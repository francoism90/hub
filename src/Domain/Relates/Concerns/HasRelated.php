<?php

namespace Domain\Relates\Concerns;

use Domain\Relates\Models\Relatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasRelated
{
    public function relatables(): MorphMany
    {
        return $this->morphMany(Relatable::class, 'model');
    }

    protected function relates(): Attribute
    {
        return Attribute::make(
            get: fn () => $this
                ->relatables()
                ->scores()
                ->get()
                ->relates()
        )->shouldCache();
    }
}
