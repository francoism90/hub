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

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'options' => AsArrayObject::class,
    ];
}
