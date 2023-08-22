<?php

namespace Domain\Imports\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self video()
 */
class ImportType extends Enum
{
    protected static function labels(): array
    {
        return [
            'video' => __('Video'),
        ];
    }
}
