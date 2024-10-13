<?php

namespace Domain\Videos\Concerns;

use ArrayAccess;
use Domain\Videos\Models\Video;
use Domain\Videos\Models\Videoable;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;

trait HasVideos
{
    public function videos(): MorphToMany
    {
        return $this->morphToMany(Video::class, 'videoable')
            ->using(Videoable::class)
            ->withPivot(['video_id', 'options'])
            ->withTimestamps();
    }

    public function attachVideo(Video $model, ?array $options = null): static
    {
        return $this->attachVideos([$model], $options);
    }

    public function attachVideos(array|ArrayAccess|Collection $videos, ?array $options = null): static
    {
        $videos = static::convertToVideos($videos);
        logger($videos);

        $this->videos()->syncWithPivotValues(
            ids: $videos->pluck('id')->toArray(),
            values: ['options' => $options, 'updated_at' => now()],
            detaching: false
        );

        return $this;
    }

    public function detachVideo(Video $video): static
    {
        return $this->detachVideos([$video]);
    }

    public function detachVideos(array|ArrayAccess|Collection $videos): static
    {
        $items = static::convertToVideos($videos);

        $items->each(fn (Video $video) => $this->videos()->detach($video));

        return $this;
    }

    public static function convertToVideos(array|ArrayAccess|Collection $values): Collection
    {
        return collect($values)
            ->map(fn (Video|int $value) => $value instanceof Video ? $value : Video::find($value))
            ->filter();
    }
}
