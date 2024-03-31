<?php

namespace Domain\Videos\Enums;

enum FilterType: string
{
    case Newest = 'newest';

    public function label(): string
    {
        return match ($this) {
            self::Newest => __('Newest'),
        };
    }
}
