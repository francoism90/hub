<?php

declare(strict_types=1);

namespace Domain\Groups\Enums;

enum GroupSet: string
{
    case Daily = 'daily';
    case Discover = 'discover';
    case Viewed = 'viewed';
    case Favorite = 'favorite';
    case Saved = 'saved';
    case Latest = 'latest';
    case Longest = 'longest';
    case Shortest = 'shortest';

    public function label(): string
    {
        return match ($this) {
            self::Daily => __('Everything'),
            self::Discover => __('New to you'),
            self::Viewed => __('Viewed'),
            self::Favorite => __('Favorite'),
            self::Saved => __('Saved'),
            self::Latest => __('Latest'),
            self::Longest => __('Longest'),
            self::Shortest => __('Shortest'),
        };
    }
}
