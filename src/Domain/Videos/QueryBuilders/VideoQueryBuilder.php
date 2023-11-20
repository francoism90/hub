<?php

namespace Domain\Videos\QueryBuilders;

use Domain\Shared\Concerns\InteractsWithRandomSeed;
use Domain\Shared\Concerns\InteractsWithScout;
use Domain\Shared\Concerns\InteractsWithTags;
use Domain\Tags\Models\Tag;
use Domain\Users\Models\User;
use Domain\Videos\Actions\GetSimilarVideos;
use Domain\Videos\Models\Video;
use Domain\Videos\States\Verified;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;

class VideoQueryBuilder extends Builder
{
    use InteractsWithRandomSeed;
    use InteractsWithScout;
    use InteractsWithTags;

    public function published(): self
    {
        return $this
            ->whereState('state', Verified::class)
            ->whereNull('deleted_at');
    }

    public function recommended(User $user = null): self
    {
        /** @var User $user */
        // $user ??= auth()->user();

        return $this
            ->published()
            ->randomSeed(key: 'feed', ttl: now()->addMinutes(20));
    }

    public function similar(Video $model): self
    {
        $items = app(GetSimilarVideos::class)->execute($model);

        return $this->when($items->isNotEmpty(), fn (Builder $query) => $query
            ->whereIn('id', $items->pluck('id'))
            ->orderByRaw('FIND_IN_SET (id, ?)', [$items->pluck('id')->implode(',')])
        );
    }

    public function tagged(Arrayable|array|Tag $values = null): self
    {
        $items = static::convertToTags($values);

        return $this->when($items->isNotEmpty(), fn (Builder $query) => $query
            ->withAnyTagsOfAnyType($items)
            ->randomSeed(key: 'tags', ttl: now()->addDay())
        );
    }
}
