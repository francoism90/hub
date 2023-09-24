<?php

namespace Domain\Imports\Actions;

use Domain\Imports\Models\Import;
use Domain\Imports\States\Finished;

class MarkAsFinished
{
    public function execute(Import $model): void
    {
        if ($model->state->canTransitionTo(Finished::class)) {
            $model->state->transitionTo(Finished::class);
        }

        $model->updateOrFail(['finished_at' => now()]);
    }
}
