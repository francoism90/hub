<?php

namespace Domain\Videos\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Support\Arr;
use Laravel\Scout\Searchable;

class Videoable extends MorphPivot
{
    use Searchable;

    /**
     * @var string
     */
    protected $table = 'videoables';

    /**
     * @var bool
     */
    public $incrementing = true;

    protected function casts(): array
    {
        return [
            'options' => AsArrayObject::class,
        ];
    }

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class, 'video_id');
    }

    public function toSearchableArray(): array
    {
        if (! $attributes = $this->video?->toSearchableArray()) {
            return [];
        }

        // Remove any conflicted attributes
        $attributes = Arr::except($attributes, ['id', 'created_at', 'updated_at']);

        return array_merge([
            'id' => (string) $this->getScoutKey(),
            'video_id' => (int) $this->video_id,
            'videoable_id' => (int) $this->videoable_id,
            'videoable_type' => (string) $this->videoable_type,
            'order_column' => (int) $this->order_column,
        ], $attributes);
    }

    public function makeSearchableUsing(Collection $models): Collection
    {
        return $models->loadMissing('video', 'video.tags');
    }

    protected function makeAllSearchableUsing(Builder $query): Builder
    {
        return $query->with(['video', 'tags']);
    }
}
