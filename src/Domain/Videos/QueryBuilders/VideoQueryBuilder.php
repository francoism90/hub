<?php

namespace Domain\Videos\QueryBuilders;

use Domain\Videos\Actions\GetSimilarVideos;
use Domain\Videos\Models\Video;
use Domain\Videos\States\Verified;
use Illuminate\Database\Eloquent\Builder;

class VideoQueryBuilder extends Builder
{
    public function published(): self
    {
        return $this
            ->whereState('state', Verified::class);
    }

    public function recommended(int $ttl = 60 * 20): self
    {
        return $this
            ->published()
            ->randomSeed('videos-recommended', $ttl);
    }

    public function random(int $ttl = 60 * 10): self
    {
        return $this
            ->published()
            ->randomSeed('videos-random', $ttl);
    }

    public function similar(Video $model): self
    {
        $items = app(GetSimilarVideos::class)->execute($model);

        return $this->when($items->isNotEmpty(), fn (Builder $query) => $query
            ->whereIn('id', $items->pluck('id'))
            ->orderByRaw('FIND_IN_SET (id, ?)', [$items->pluck('id')->implode(',')])
        );
    }
}
