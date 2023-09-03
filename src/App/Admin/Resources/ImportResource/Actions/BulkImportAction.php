<?php

namespace App\Admin\Resources\ImportResource\Actions;

use Domain\Imports\Actions\BulkImport;
use Domain\Imports\Enums\ImportType;
use Filament\Actions\Action;
use Filament\Actions\Concerns\CanCustomizeProcess;

class BulkImportAction extends Action
{
    use CanCustomizeProcess;

    public static function getDefaultName(): ?string
    {
        return 'bulk_import';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('Bulk Import'));

        $this->icon('heroicon-o-squares-plus');

        $this->successNotificationTitle(__('Import Completed'));

        $this->action(function (): void {
            $this->process(fn () => app(BulkImport::class)->execute(
                ImportType::video()
            ));

            $this->success();
        });
    }
}
