<?php

namespace App\Admin\Resources\TagResource\Actions;

use Domain\Tags\Actions\SetTagsOrder;
use Filament\Actions\Action;
use Filament\Actions\Concerns\CanCustomizeProcess;

class SortAction extends Action
{
    use CanCustomizeProcess;

    public static function getDefaultName(): ?string
    {
        return 'sort';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('Sort Tags'));

        $this->icon('heroicon-o-bars-3-bottom-left');

        $this->requiresConfirmation();

        $this->successNotificationTitle(__('Tags Sorted'));

        $this->action(function (): void {
            $this->process(fn () => app(SetTagsOrder::class)->execute());

            $this->success();
        });
    }
}
