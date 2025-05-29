<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Domain\Videos\Jobs\OptimizeVideo;
use Domain\Videos\Jobs\ProcessVideo;
use Domain\Videos\Jobs\ReleaseVideo;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\Bus;

class RegenerateVideo
{
    public function execute(Video $video): void
    {
        if ($video->trashed()) {
            return;
        }

        Bus::chain([
            new ProcessVideo($video),
            new OptimizeVideo($video),
            new ReleaseVideo($video),
        ])->dispatch();
    }
}
