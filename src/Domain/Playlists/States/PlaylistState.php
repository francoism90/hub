<?php

namespace Domain\Playlists\States;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class PlaylistState extends State
{
    abstract public function color(): string;

    abstract public function label(): string;

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Pending::class)
            ->allowTransition(Pending::class, Verified::class);
    }
}
