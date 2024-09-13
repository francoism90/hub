<?php

namespace Domain\Videos\Concerns;

use Domain\Videos\Models\Video;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait InteractsWithVideos
{
    public function videos(): HasMany
    {
        return $this->hasMany(Video::class)->chaperone();
    }
}
