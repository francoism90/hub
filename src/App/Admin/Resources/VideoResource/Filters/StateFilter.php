<?php

namespace App\Admin\Resources\VideoResource\Filters;

use App\Admin\Concerns\InteractsWithState;
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

        $this->options(static::stateOptions(VideoState::class));
    }
}
