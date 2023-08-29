<?php

namespace Domain\Playlists\States;

class Verified extends PlaylistState
{
    public static $name = 'verified';

    public function label(): string
    {
        return __('Verified');
    }

    public function color(): string
    {
        return 'green';
    }
}
