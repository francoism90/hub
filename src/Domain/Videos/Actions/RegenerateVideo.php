<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Closure;
use Domain\Videos\Jobs\OptimizeVideo;
use Domain\Videos\Jobs\ProcessVideo;
use Domain\Videos\Jobs\ReleaseVideo;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\Bus;

class RegenerateVideo
{
    public function __invoke(Video $model, Closure $next): mixed
    {
        Bus::chain([
            new ProcessVideo($model),
            new OptimizeVideo($model),
            new ReleaseVideo($model),
        ])->dispatch();

        return $next($model);
    }
}
