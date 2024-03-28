<?php

namespace Domain\Videos\Enums;

enum FilterType: string
{
    case Recent = 'recent';
    case Watched = 'watched';
    case Unwatched = 'unwatched';

    public function label(): string
    {
        return match ($this) {
            self::Recent => __('Recent uploaded'),
            self::Watched => __('Watched'),
            self::Unwatched => __('New to you'),
        };
    }
}
