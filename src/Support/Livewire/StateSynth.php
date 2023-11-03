<?php

namespace Support\Livewire\Synthesizers;


use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;
use Spatie\ModelStates\State;

class StateSynth extends Synth
{
    public static $key = 'state';

    static function match($target)
    {
        return $target instanceof State;
    }

    function dehydrate($target)
    {
        return [$target->getMorphClass(), []];
    }

    function hydrate($value)
    {
        return $value;
    }
}
