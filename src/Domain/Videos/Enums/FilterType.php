<?php

namespace Domain\Videos\Enums;

enum FilterType: string
{
    case Newest = 'newest';
    case Watched = 'watched';

    public function label(): string
    {
        return match ($this) {
            self::Newest => __('Newest'),
            self::Watched => __('Watched'),
        };
    }
}
