<?php

namespace Domain\Videos\QueryBuilders;

use Domain\Videos\States\Verified;
use Illuminate\Database\Eloquent\Builder;

class VideoQueryBuilder extends Builder
{
    public function published(): self
    {
        return $this->whereState('state', Verified::class);
    }

    public function recent(): self
    {
        return $this
            ->orderByDesc('created_at')
            ->orderByDesc('released_at');
    }

    public function feed(int $ttl = 60 * 20): self
    {
        return $this->randomSeed('videos-feed', $ttl);
    }

    public function recommended(int $ttl = 60 * 20): self
    {
        return $this->randomSeed('videos-recommended', $ttl);
    }

    public function tagged(int $ttl = 60 * 20): self
    {
        return $this->randomSeed('videos-tagged', $ttl);
    }
}
