<?php

namespace Domain\Videos\Enums;

enum FilterType: string
{
    case Newest = 'newest';
    case Watched = 'watched';
    case Unwatched = 'unwatched';

    public function label(): string
    {
        return match ($this) {
            self::Newest => __('Newest'),
            self::Watched => __('Watched'),
            self::Unwatched => __('New to you'),
        };
    }
}
