<?php

namespace Domain\Tags\Enums;

enum TagType: string
{
    case Genre = 'genre';
    case Studio = 'studio';
    case Person = 'person';
    case Language = 'language';

    public function label(): string
    {
        return match($this) {
            self::Genre => __('Genre'),
            self::Studio => __('Studio'),
            self::Person => __('Person'),
            self::Language => __('Language'),
        };
    }
}
