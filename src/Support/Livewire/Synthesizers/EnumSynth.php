<?php

namespace Support\Livewire\Synthesizers;


use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;
use Spatie\Enum\Laravel\Enum;

class EnumSynth extends Synth
{
    public static $key = 'enm';

    static function match($target)
    {
        return $target instanceof Enum;
    }

    function dehydrate($target)
    {
        return [
            $target->value,
            ['class' => get_class($target)]
        ];
    }

    function hydrate($value, $meta)
    {
        if (blank($value)) {
            return null;
        }

        $class = $meta['class'];

        return $class::from($value);
    }
}
