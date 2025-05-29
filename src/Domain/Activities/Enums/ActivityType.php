<?php

declare(strict_types=1);

namespace Domain\Activities\Enums;

enum ActivityType: string
{
    case Bookmark = 'bookmark';
    case Favorite = 'favorite';
    case Unfavorite = 'unfavorite';
    case Like = 'like';
    case Dislike = 'dislike';
    case Follow = 'follow';
    case Unfollow = 'unfollow';
    case Reaction = 'reaction';

    public function label(): string
    {
        return match ($this) {
            self::Bookmark => __('Bookmark'),
            self::Favorite => __('Favorite'),
            self::Unfavorite => __('Unfavorite'),
            self::Like => __('Like'),
            self::Dislike => __('Dislike'),
            self::Follow => __('Follow'),
            self::Unfollow => __('Unfollow'),
            self::Reaction => __('Reaction'),
        };
    }
}
