<?php

declare(strict_types=1);

namespace Domain\Users\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Userable extends MorphPivot
{
    /**
     * @var string
     */
    protected $table = 'userables';

    protected function casts(): array
    {
        return [
            'options' => AsArrayObject::class,
        ];
    }
}
