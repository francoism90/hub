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
            TagType::Genre => __('Genre'),
            TagType::Studio => __('Studio'),
            TagType::Person => __('Person'),
            TagType::Language => __('Language'),
        };
    }
}
