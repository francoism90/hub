<?php

namespace App\Web\Videos\Concerns;

use Domain\Videos\Models\Video;

trait WithVideo
{
    public Video $video;

    public function bootWithVideo(): void
    {
        $this->authorize('view', $this->video);
    }
}
