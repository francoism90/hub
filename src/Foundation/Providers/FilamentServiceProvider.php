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
            $sanitize = fn (?string $state): ?string => filled($state)
                ? str($state)->squish()
                : $state;

            return $this
                ->afterStateUpdated(fn (TextInput $component, Set $set, ?string $state) => $set($component->getStatePath(false), $sanitize($state)))
                ->dehydrateStateUsing(fn (?string $state): ?string => $sanitize($state));
        });
    }

    protected function configureFields(): void
    {
        TextInput::configureUsing(fn (TextInput $component) => $component->squish());
    }
}
