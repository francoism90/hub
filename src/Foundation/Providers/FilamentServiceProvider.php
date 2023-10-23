<?php

namespace Foundation\Providers;

use Filament\Forms\Components;
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
        Components\Field::macro('trim', fn (): static => $this
            ->afterStateUpdated(fn (Components\TextInput $component, mixed $state, Set $set) => $set($component->getName(), trim($state)))
            ->dehydrateStateUsing(fn (mixed $state): mixed => trim($state))
        );
    }

    protected function configureFields(): void
    {
        Components\TextInput::configureUsing(function (Components\TextInput $component): void {
            $component->trim();
        });
    }
}
