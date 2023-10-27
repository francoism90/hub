<?php

namespace Foundation\Providers;

use Filament\Forms\Components\Field;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Set;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->configureMacros();
        $this->configureFields();
    }

    protected function configureMacros(): void
    {
        Field::macro('squish', function () {
            $value = fn (mixed $state) => is_string($state) && filled($state)
                ? str($state)->squish()->value()
                : $state;

            return $this
                ->afterStateUpdated(fn (TextInput $component, mixed $state, Set $set) => $set($component->getName(), $value($state)))
                ->dehydrateStateUsing(fn (mixed $state): mixed => $value($state));
        });
    }

    protected function configureFields(): void
    {
        TextInput::configureUsing(function (TextInput $component): void {
            $component->squish();
        });
    }
}
