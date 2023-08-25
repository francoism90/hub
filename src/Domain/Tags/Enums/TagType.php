<?php

namespace Domain\Tags\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self genre()
 * @method static self studio()
 * @method static self person()
 * @method static self language()
 */
class TagType extends Enum
{
    protected static function labels(): array
    {
        return [
            'genre' => __('Genre'),
            'studio' => __('Studio'),
            'person' => __('Person'),
            'language' => __('Language'),
        ];
    }
}
