<?php

declare(strict_types=1);

namespace Domain\Groups\Enums;

enum GroupCategory: string
{
    case Daily = 'daily';
    case Discover = 'discover';

    public function label(): string
    {
        return match ($this) {
            self::Daily => __('Everything'),
            self::Discover => __('New to you'),
        };
    }
}
