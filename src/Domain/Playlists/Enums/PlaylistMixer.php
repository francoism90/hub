<?php

namespace Domain\Playlists\Enums;

enum PlaylistMixer: string
{
    case Daily = 'daily';
    case Discover = 'discover';

    public function label(): string
    {
        return match ($this) {
            self::Daily => __('Daily'),
            self::Discover => __('New to you'),
        };
    }
}
