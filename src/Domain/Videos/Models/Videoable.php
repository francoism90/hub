<?php

namespace Domain\Videos\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Videoable extends MorphPivot
{
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

    public function videoable(): MorphTo
    {
        return $this->morphTo();
    }

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class, 'video_id');
    }
}
