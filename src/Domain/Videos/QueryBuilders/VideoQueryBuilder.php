<?php

namespace Domain\Videos\QueryBuilders;

use Domain\Tags\Collections\TagCollection;
use Domain\Tags\Models\Tag;
use Domain\Users\Models\User;
use Domain\Videos\Actions\GetSimilarVideos;
use Domain\Videos\Models\Video;
use Domain\Videos\States\Verified;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;

class VideoQueryBuilder extends Builder
{
    public function published(): self
    {
        return $this
            ->whereState('state', Verified::class);
    }

    public function newest(): self
    {
        return $this
        ->orderByDesc('created_at')
        ->orderByDesc('released_at');
    }

    public function watched(): self
    {
        /** @var User */
        $user = auth()->user();

        return $this
            ->randomSeed(key: 'videos-feed', ttl: now()->addMinutes(10))
            ->withWhereHas('playlists', fn ($query) => $query
                ->history()
                ->where('user_id', $user->getKey())
                ->has('videos')
            );
    }

    public function similar(Video $model): self
    {
        $items = app(GetSimilarVideos::class)->execute($model);

        return $this->when($items->isNotEmpty(), fn (Builder $query) => $query
            ->whereIn('id', $items->pluck('id'))
            ->orderByRaw('FIND_IN_SET (id, ?)', [$items->pluck('id')->implode(',')])
        );
    }

    public function tagged(Arrayable|array|Tag|null $values = null): Builder
    {
        $items = TagCollection::make($values)->toModels();

        return $this
            ->randomSeed(key: 'tagged', ttl: now()->addDay())
            ->whereHas('tags', fn (Builder $query) => $query
                ->whereIn('id', $items->modelKeys())
            );
    }
}
