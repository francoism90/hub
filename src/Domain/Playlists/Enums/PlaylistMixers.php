<?php

namespace Domain\Playlists\Enums;

enum PlaylistMixers: string
{
    case Daily = 'daily';

    public function label(): string
    {
        return match ($this) {
            self::Daily => __('Daily'),
        };
    }
}
