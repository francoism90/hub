<?php

namespace App\Livewire\Dashboard\Videos\States;

use Domain\Videos\Models\Video;
use Foxws\WireUse\States\Support\State;
use Livewire\Attributes\Locked;

class VideoState extends State
{
    #[Locked]
    public ?string $id = null;

    protected function beforeStateFill(Video $model): array
    {
        return ['id' => $model->getRouteKey()];
    }
}
