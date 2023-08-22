<?php

namespace Domain\Imports\States;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class ImportState extends State
{
    abstract public function color(): string;

    abstract public function label(): string;

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Pending::class)
            ->allowTransition(Pending::class, Finished::class)
            ->allowTransition(Pending::class, Failed::class);
    }
}
