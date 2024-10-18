<?php

declare(strict_types=1);

namespace Domain\Groups\Enums;

enum GroupSet: string
{
    case Daily = 'daily';
    case Discover = 'discover';
    case Viewed = 'viewed';
    case Tagged = 'tagged';
    case Favorite = 'favorite';
    case Saved = 'saved';
    case Newest = 'newest';
    case Oldest = 'oldest';
    case Recommended = 'recommended';
    case Relevant = 'relevant';
    case Longest = 'longest';
    case Shortest = 'shortest';

    public function label(): string
    {
        return match ($this) {
            self::Daily => __('Everything'),
            self::Discover => __('New to you'),
            self::Viewed => __('History'),
            self::Tagged => __('Tagged'),
            self::Favorite => __('Favorite'),
            self::Saved => __('Saved'),
            self::Newest => __('Newest'),
            self::Oldest => __('Oldest'),
            self::Recommended => __('Recommended'),
            self::Relevant => __('Relevant'),
            self::Longest => __('Longest'),
            self::Shortest => __('Shortest'),
        };
    }
}
