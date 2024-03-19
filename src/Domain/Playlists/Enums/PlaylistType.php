<?php

namespace Domain\Playlists\Enums;

enum PlaylistType: string
{
    case System = 'system';
    case Mixer = 'mixer';

    public function label(): string
    {
        return match ($this) {
            self::System => __('System'),
            self::Mixer => __('Mixer'),
        };
    }
}
