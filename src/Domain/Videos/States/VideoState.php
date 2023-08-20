<?php

namespace Domain\Videos\States;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class VideoState extends State
{
    abstract public function color(): string;

    abstract public function label(): string;

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Pending::class)
            ->allowTransition(Pending::class, Verified::class)
            ->allowTransition(Pending::class, Failed::class);
    }
}
