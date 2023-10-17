<?php

namespace App\Admin\Actions;

use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Component;

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

        $this->disabled(fn (mixed $state): bool => blank($state));

        $this->action(function (): void {
            $this->process(function (Component $component, mixed $state) {
                $component->state(
                    str($state)
                        ->replace(['.', '_', '-'], ' ')
                        ->squish()
                        ->title()
                        ->trim()
                        ->value()
                );
            });

            $this->success();
        });
    }
}
