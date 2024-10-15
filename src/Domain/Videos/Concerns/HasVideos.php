<?php

declare(strict_types=1);

namespace Domain\Videos\Concerns;

use ArrayAccess;
use Domain\Videos\DataObjects\VideoableData;
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

    public function attachVideo(Video $model, ?VideoableData $data = null): static
    {
        return $this->attachVideos([$model], $data);
    }

    public function attachVideos(array|ArrayAccess|Collection $videos, ?VideoableData $data = null, bool $detach = false): static
    {
        $videos = static::convertToVideos($videos);

        $this->videos()->syncWithPivotValues(
            ids: $videos->pluck('id')->toArray(),
            values: ['options' => $data->toArray(), 'updated_at' => now()],
            detaching: $detach,
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
