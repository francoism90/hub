<?php

namespace Domain\Relates\Collections;

use Domain\Relates\Models\Relatable;
use Illuminate\Database\Eloquent\Collection;

class RelatedCollection extends Collection
{
    public function relates(): self
    {
        return $this
            ->loadMissing('relate')
            ->transform(fn (Relatable $relatable) => $relatable->relate);
    }
}
