<?php

namespace App\Admin\Resources\VideoResource\Actions;

use App\Admin\Concerns\InteractsWithPlaylists;
use Domain\Videos\Actions\RegenerateVideo;
use Filament\Actions\Action;
use Filament\Actions\Concerns\CanCustomizeProcess;
use Illuminate\Database\Eloquent\Model;

class RegenerateAction extends Action
{
    use CanCustomizeProcess;
    use InteractsWithPlaylists;

    public static function getDefaultName(): ?string
    {
        return 'regenerate_video';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->icon('heroicon-o-document-check');

        $this->label(__('Regenerate'));

        $this->successNotificationTitle(__('Job Queued'));

        $this->action(function (): void {
            $this->process(function (Model $record) {
                app(RegenerateVideo::class)->execute($record);
            });

            $this->success();
        });
    }
}
