<?php

namespace Domain\Groups\States;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class GroupState extends State
{
    abstract public function label(): string;

    abstract public function color(): string;

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Pending::class)
            ->allowTransition(Pending::class, Verified::class);
    }
}
