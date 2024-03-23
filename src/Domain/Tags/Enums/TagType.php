<?php

namespace Domain\Tags\Enums;

enum TagType: string
{
    case Person = 'person';
    case Studio = 'studio';
    case Genre = 'genre';
    case Language = 'language';

    public function label(): string
    {
        return match ($this) {
            self::Person => __('Person'),
            self::Studio => __('Studio'),
            self::Genre => __('Genre'),
            self::Language => __('Language'),
        };
    }
}
