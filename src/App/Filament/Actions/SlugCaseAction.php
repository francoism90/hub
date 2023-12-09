<?php

namespace App\Filament\Actions;

use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Component;

class SlugCaseAction extends Action
{
    use CanCustomizeProcess;

    public static function getDefaultName(): ?string
    {
        return 'slug_case';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->icon('heroicon-o-language');

        $this->label(__('Slug Case'));

        $this->hiddenLabel();

        $this->action(function (): void {
            $this->process(function (Component $component, mixed $state) {
                if (blank($state) || ! is_string($state)) {
                    return $state;
                }

                $component->state(
                    str((string) $state)
                        ->replace('.', ' ')
                        ->slug()
                        ->upper()
                        ->squish()
                        ->value()
                );
            });

            $this->success();
        });
    }
}
