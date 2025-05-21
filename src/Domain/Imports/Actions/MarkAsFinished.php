<?php

declare(strict_types=1);

namespace Domain\Imports\Actions;

use Closure;
use Domain\Imports\Models\Import;
use Domain\Imports\States\Finished;

class MarkAsFinished
{
    public function __invoke(Import $model, Closure $next): mixed
    {
        if ($model->state->canTransitionTo(Finished::class)) {
            $model->state->transitionTo(Finished::class);
        }

        $model->updateOrFail(['finished_at' => now()]);

        return $next($model);
    }
}
