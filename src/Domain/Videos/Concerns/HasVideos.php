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

    public function attachVideo(Video $model, array $options = null): static
    {
        return $this->attachVideos([$model], $options);
    }

    public function attachVideos(array|ArrayAccess|Video $videos, array $options = null): static
    {
        $videos = static::convertToVideos($videos);

        $this->videos()->syncWithPivotValues(
            ids: $videos->pluck('id')->toArray(),
            values: ['options' => $options],
            detaching: false
        );

        return $this;
    }

    public function detachVideo(Video $video): static
    {
        return $this->detachVideos([$video]);
    }

    public function detachVideos(array|ArrayAccess $videos): static
    {
        $videos = static::convertToVideos($videos);

        collect($videos)
            ->filter()
            ->each(fn (Video $video) => $this->videos()->detach($video));

        return $this;
    }

    public static function convertToVideos(array|ArrayAccess|Video $values): Collection
    {
        if ($values instanceof Video) {
            $values = [$values];
        }

        return collect($values)
            ->map(fn (Video|int $value) => $value instanceof Video
                ? $value
                : Video::find($value));
    }
}
