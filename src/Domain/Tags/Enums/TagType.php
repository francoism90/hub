<?php

namespace Domain\Tags\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self studio()
 * @method static self genre()
 * @method static self language()
 * @method static self person()
 */
class TagType extends Enum
{
    protected static function labels(): array
    {
        return [
            'studio' => __('Studio'),
            'genre' => __('Genre'),
            'language' => __('Language'),
            'person' => __('Person'),
        ];
    }
}
