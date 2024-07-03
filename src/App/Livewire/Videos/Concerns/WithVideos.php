<?php

namespace App\Livewire\Videos\Concerns;

use Domain\Videos\Models\Video;

trait WithVideos
{
    public function bootWithVideos(): void
    {
        $this->authorize('viewAny', Video::class);
    }
}
