<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Closure;
use Domain\Videos\Models\Video;
use Domain\Videos\States\Verified;

class MarkVideoVerified
{
    public function __invoke(Video $model, Closure $next): mixed
    {
        if (! $model->state->canTransitionTo(Verified::class)) {
            return $next($model);
        }

        $model->state->transitionTo(Verified::class);

        return $next($model);
    }
}
