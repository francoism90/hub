<?php

namespace Domain\Videos\Actions;

use Domain\Videos\Jobs\OptimizeVideo;
use Domain\Videos\Jobs\ProcessVideo;
use Domain\Videos\Jobs\ReleaseVideo;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\Bus;

class RegenerateVideo
{
    public function execute(Video $model): void
    {
        Bus::chain([
            new ProcessVideo($model),
            new OptimizeVideo($model),
            new ReleaseVideo($model),
        ])->dispatch();
    }
}
