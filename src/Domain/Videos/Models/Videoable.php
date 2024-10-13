<?php

namespace Domain\Videos\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Laravel\Scout\Searchable;

class Videoable extends MorphPivot
{
    use Searchable;

    /**
     * @var string
     */
    protected $table = 'videoables';

    protected function casts(): array
    {
        return [
            'options' => AsArrayObject::class,
        ];
    }

    public function toSearchableArray(): array
    {
        if (! $attributes = Video::find($this->video_id)?->toSearchableArray()) {
            return [];
        }

        return array_merge($attributes, [
            'id' => (int) $this->getScoutKey(),
            'video_id' => (int) $this->video_id,
            'videoable_id' => (int) $this->videoable_id,
            'videoable_type' => (string) $this->videoable_type,
            'order_column' => (int) $this->order_column,
        ]);
    }

    // public function makeSearchableUsing(Collection $models): Collection
    // {
    //     return $models->loadMissing('tags');
    // }

    // protected function makeAllSearchableUsing(VideoQueryBuilder $query): VideoQueryBuilder
    // {
    //     return $query->with(['media', 'tags']);
    // }
}
