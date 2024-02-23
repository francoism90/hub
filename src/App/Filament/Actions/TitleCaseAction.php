<?php

namespace App\Filament\Actions;

use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Component;
use Filament\Forms\Set;

class TitleCaseAction extends Action
{
    use CanCustomizeProcess;

    public static function getDefaultName(): ?string
    {
        return 'title_case';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->icon('heroicon-o-language');

        $this->label(__('Title Case'));

        $this->hiddenLabel();

        $this->action(function (): void {
            $this->process(function (Component $component, Set $set, mixed $state) {
                if (blank($state) || ! is_string($state)) {
                    return $state;
                }

                $set($component, $this->convert($state));
            });

            $this->success();
        });
    }

    protected function convert(?string $state = null): string
    {
        return str($state)
            ->replace(['.', '_'], ' ')
            ->title()
            ->squish()
            ->value();
    }
}
