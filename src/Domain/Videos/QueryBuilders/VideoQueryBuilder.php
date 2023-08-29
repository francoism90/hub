<?php

namespace Domain\Videos\QueryBuilders;

use ArrayAccess;
use Domain\Playlists\Enums\PlaylistType;
use Domain\Shared\Concerns\InteractsWithScout;
use Domain\Tags\Models\Tag;
use Domain\Users\Models\User;
use Domain\Videos\Actions\GetSimilarVideos;
use Domain\Videos\Models\Video;
use Illuminate\Database\Eloquent\Builder;

class VideoQueryBuilder extends Builder
{
    use InteractsWithScout;

    public function captions(): self
    {
        return $this->where(fn (Builder $query) => $query
            ->whereRelation('media', 'collection_name', 'captions')
            ->orWhereRelation('media', 'custom_properties->closed_captions', 1)
            ->orWhereRelation('media', 'custom_properties->burnin_captions', 1)
        );
    }

    public function duration(string $direction = 'DESC'): self
    {
        return $this
            ->whereRelation('media', 'collection_name', 'clips')
            ->whereRelation('media', 'custom_properties->duration', '>=', 0)
            ->withAvg('media as duration_avg', 'custom_properties->duration')
            ->reorder()
            ->orderBy('duration_avg', $direction);
    }

    public function quality(string $direction = 'DESC'): self
    {
        return $this
            ->whereRelation('media', 'collection_name', 'clips')
            ->whereRelation('media', 'custom_properties->width', '>=', 1280)
            ->whereRelation('media', 'custom_properties->height', '>=', 360)
            ->withAvg('media as width_avg', 'custom_properties->width')
            ->reorder()
            ->orderBy('width_avg', $direction);
    }

    public function recommended(User $user = null): self
    {
        /** @var User $user */
        // $user ??= auth()->user();

        return $this
            ->inRandomSeedOrder();
    }

    public function favorites(User $user = null): self
    {
        /** @var User $user */
        $user ??= auth()->user();

        return $this
            ->joinRelationship('favorites', fn ($join) => $join
                ->when($user, fn ($join) => $join->where('favorites.user_id', $user->id))
            )
            ->reorder()
            ->orderByPowerJoins('favorites.created_at', 'DESC');
    }

    public function following(User $user = null): self
    {
        /** @var User $user */
        $user ??= auth()->user();

        return $this
            ->joinRelationship('followables', fn ($join) => $join
                ->when($user, fn ($join) => $join->where('followables.user_id', $user->id))
            )
            ->reorder()
            ->orderByPowerJoins('followables.created_at', 'DESC');
    }

    public function viewed(User $user = null): self
    {
        /** @var User $user */
        $user ??= auth()->user();

        return $this
            ->joinRelationship('views', fn ($join) => $join
                ->when($user, fn ($join) => $join->where('visitor', $user->id))
            )
            ->reorder()
            ->orderByPowerJoins('views.viewed_at', 'DESC');
    }

    public function similar(Video $model): self
    {
        $items = app(GetSimilarVideos::class)->execute($model);

        $ids = $items->pluck('id')->all();
        $idsOrder = implode(',', $ids);

        return $this->when($items->isNotEmpty(),
            fn (Builder $query) => $query
                ->reorder()
                ->whereIn('id', $ids)
                ->orderByRaw("FIELD (id, {$idsOrder})"),
            fn (Builder $query) => $query
                ->where('id', 0)
        );
    }

    public function history(User $user = null): self
    {
        /** @var User $user */
        $user ??= auth()->user();

        return $this
            ->joinRelationship('playlists');
            // ->reorder()
            // ->orderByPowerJoins('views.viewed_at', 'DESC');
    }

    public function tags(Tag|array|ArrayAccess $tags): self
    {
        $items = collect($tags)
            ->unique()
            ->map(fn (Tag|string $item) => ! $item instanceof Tag
                ? Tag::findByPrefixedId($item)
                : $item
            )
            ->filter();

        return $this
            ->when($items->isNotEmpty(), fn (Builder $query) => $query
                ->inRandomSeedOrder()
                ->WithAnyTags($items)
            );
    }
}
