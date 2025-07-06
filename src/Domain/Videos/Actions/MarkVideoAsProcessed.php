<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Closure;
use Domain\Videos\Events\VideoHasBeenProcessed;
use Domain\Videos\Models\Video;
use Domain\Videos\States\Verified;

class MarkVideoAsProcessed
{
    public function __invoke(Video $model, Closure $next): mixed
    {
        if ($model->state->canTransitionTo(Verified::class)) {
            $model->state->transitionTo(Verified::class);
        }

        VideoHasBeenProcessed::dispatch($model);

        return $next($model);
    }
}
