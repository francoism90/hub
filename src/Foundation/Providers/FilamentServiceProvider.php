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
        Field::macro('squish', fn (): static => $this
            ->afterStateUpdated(fn (TextInput $component, mixed $state, Set $set) => is_string($state) ? $set($component->getName(), str($state)->squish()) : $state)
            ->dehydrateStateUsing(fn (mixed $state): mixed => is_string($state) ? str($state)->squish() : $state)
        );
    }

    protected function configureFields(): void
    {
        TextInput::configureUsing(function (TextInput $component): void {
            $component->squish();
        });
    }
}
