<?php

declare(strict_types=1);

namespace Domain\Activities\Enums;

enum ActivityType: string
{
    case Bookmark = 'bookmark';
    case Favorite = 'favorite';
    case Like = 'like';
    case Reaction = 'reaction';

    public function label(): string
    {
        return match ($this) {
            self::Bookmark => __('Bookmark'),
            self::Favorite => __('Favorite'),
            self::Like => __('Like'),
            self::Reaction => __('Reaction'),
        };
    }
}
