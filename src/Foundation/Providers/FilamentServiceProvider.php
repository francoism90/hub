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
        Field::macro('trim', fn (): static => $this
            ->afterStateUpdated(fn (TextInput $component, mixed $state, Set $set) => is_string($state) ? $set($component->getName(), trim($state)) : $state)
            ->dehydrateStateUsing(fn (mixed $state): mixed => is_string($state) ? trim($state) : $state)
        );
    }

    protected function configureFields(): void
    {
        TextInput::configureUsing(function (TextInput $component): void {
            $component->trim();
        });
    }
}
