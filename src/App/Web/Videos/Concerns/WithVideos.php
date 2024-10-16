<?php

declare(strict_types=1);

namespace App\Web\Videos\Concerns;

use Domain\Videos\Models\Video;

trait WithVideos
{
    public function bootWithVideos(): void
    {
        $this->authorize('viewAny', Video::class);
    }
}
