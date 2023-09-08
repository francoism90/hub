<?php

namespace App\Admin\Resources\ImportResource\Actions;

use Domain\Imports\States\Finished;
use Domain\Videos\Jobs\ImportVideo;
use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;

class ImportAction extends Action
{
    use CanCustomizeProcess;

    public static function getDefaultName(): ?string
    {
        return 'import';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('Import'));

        $this->disabled(fn (Model $record) => $record->state?->equals(Finished::class));

        $this->successNotificationTitle(__('Job Queued'));

        $this->action(function (): void {
            $this->process(fn (Model $record) => ImportVideo::dispatch($record));

            $this->success();
        });
    }
}
