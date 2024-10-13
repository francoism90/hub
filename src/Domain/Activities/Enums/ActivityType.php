<?php

namespace Domain\Activities\Enums;

enum ActivityType: string
{
    case Bookmark = 'bookmark';
    case Favorite = 'favorite';
    case Like = 'like';
    case Reaction = 'reaction';
    case Viewed = 'viewed';

    public function label(): string
    {
        return match ($this) {
            self::Bookmark => __('Bookmark'),
            self::Favorite => __('Favorite'),
            self::Like => __('Like'),
            self::Reaction => __('Reaction'),
            self::Viewed => __('Viewed'),
        };
    }
}
