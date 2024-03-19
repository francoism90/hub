<?php

namespace Domain\Videos\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Videoable extends MorphPivot
{
    /**
     * @var string
     */
    protected $primaryKey = 'video_id';

    protected function casts(): array
    {
        return [
            'options' => AsArrayObject::class,
        ];
    }
}
