<?php

namespace Domain\Playlists\Enums;

enum PlaylistType: string
{
    case System = 'system';
    case Mixer = 'mixer';

    public function label(): string
    {
        return match($this) {
            PlaylistType::System => __('System'),
            PlaylistType::Mixer => __('Mixer'),
        };
    }
}
