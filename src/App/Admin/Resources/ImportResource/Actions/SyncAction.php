<?php

namespace App\Admin\Resources\ImportResource\Actions;

use Domain\Imports\Actions\SyncImports;
use Domain\Imports\Enums\ImportType;
use Filament\Actions\Action;
use Filament\Actions\Concerns\CanCustomizeProcess;

class SyncAction extends Action
{
    use CanCustomizeProcess;

    public static function getDefaultName(): ?string
    {
        return 'sync';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('Scan'));

        $this->icon('heroicon-o-arrow-path');

        $this->successNotificationTitle(__('Sync Completed'));

        $this->action(function (): void {
            $this->process(fn () => app(SyncImports::class)->execute(
                ImportType::video()
            ));

            $this->success();
        });
    }
}
