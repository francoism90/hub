<?php

declare(strict_types=1);

namespace Domain\Groups\Enums;

enum GroupClass: string
{
    case Daily = 'daily';
    case Discover = 'discover';
    case Watched = 'watched';

    public function label(): string
    {
        return match ($this) {
            self::Daily => __('Everything'),
            self::Discover => __('New to you'),
            self::Watched => __('Watched'),
        };
    }
}
