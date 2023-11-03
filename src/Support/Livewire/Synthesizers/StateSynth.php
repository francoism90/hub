<?php

namespace Support\Livewire\Synthesizers;

use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;
use Spatie\ModelStates\State;

class StateSynth extends Synth
{
    public static $key = 'state';

    public static function match($target)
    {
        return $target instanceof State;
    }

    public function dehydrate($target)
    {
        return [$target->getMorphClass(), []];
    }

    public function hydrate($value)
    {
        return $value;
    }
}
