<?php

namespace App\Filament\Resources\VideoResource\Actions;

use App\Filament\Concerns\InteractsWithPlaylists;
use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Component;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Model;

class CurrentTimeAction extends Action
{
    use CanCustomizeProcess;
    use InteractsWithPlaylists;

    public static function getDefaultName(): ?string
    {
        return 'current_time';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->icon('heroicon-o-camera');

        $this->label(__('Current time'));

        $this->hiddenLabel();

        $this->action(function (): void {
            $this->process(function (Component $component, Model $record, Set $set, mixed $state = null) {
                $videoable = static::history()
                    ->videos()
                    ->firstWhere('id', $record->getKey());

                $set($component, $videoable?->pivot?->options['timestamp'] ?: $state);
            });

            $this->success();
        });
    }
}
