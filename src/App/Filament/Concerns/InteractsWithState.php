<?php

namespace App\Filament\Concerns;

use Illuminate\Support\Collection;
use ReflectionClass;
use Spatie\ModelStates\State;

trait InteractsWithState
{
    protected static function stateOptions(State|string $state): Collection
    {
        $states = call_user_func([$state, 'all']);

        return $states
            ->mapWithKeys(function (string $class) {
                $relector = new ReflectionClass($class);

                /** @var State */
                $state = $relector->newInstanceWithoutConstructor();

                $label = $relector->hasMethod('label')
                    ? $state->label()
                    : $state->getValue();

                return [$state->getMorphClass() => $label];
            });
    }
}
