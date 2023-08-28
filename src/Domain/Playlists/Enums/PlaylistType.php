<?php

namespace Domain\Tags\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self system()
 * @method static self private()
 * @method static self public()
 */
class PlaylistType extends Enum
{
    protected static function labels(): array
    {
        return [
            'system' => __('System'),
            'private' => __('Private'),
            'public' => __('Public'),
        ];
    }
}
