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

    protected function casts(): array
    {
        return [
            'options' => AsArrayObject::class,
        ];
    }
}
