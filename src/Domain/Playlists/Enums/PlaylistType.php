<?php

namespace Domain\Playlists\Enums;

enum PlaylistType: string
{
    case Mixer = 'mixer';
    case Private = 'private';
    case Public = 'public';

    public function label(): string
    {
        return match ($this) {
            self::Mixer => __('Mixer'),
            self::Private => __('Private'),
            self::Public => __('Public'),
        };
    }
}
