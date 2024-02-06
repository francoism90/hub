<?php

namespace App\Filament\Resources\VideoResource\Filters;

use App\Filament\Concerns\InteractsWithState;
use Domain\Videos\States\VideoState;
use Filament\Tables\Filters\SelectFilter;

class StateFilter extends SelectFilter
{
    use InteractsWithState;

    public static function getDefaultName(): ?string
    {
        return 'state';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->options(
            static::stateOptions(VideoState::class)
        );
    }
}
