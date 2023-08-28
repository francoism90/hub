<?php

namespace Domain\Users\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Userable extends MorphPivot
{
    /**
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'options' => AsArrayObject::class,
    ];
}
