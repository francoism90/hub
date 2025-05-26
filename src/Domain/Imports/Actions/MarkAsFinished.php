<?php

declare(strict_types=1);

namespace Domain\Imports\Actions;

use Domain\Imports\Models\Import;
use Domain\Imports\States\Finished;
use Illuminate\Support\Facades\DB;

class MarkAsFinished
{
    public function execute(Import $model): mixed
    {
        return DB::transaction(function () use ($model) {
            if ($model->state->canTransitionTo(Finished::class)) {
                $model->state->transitionTo(Finished::class);
            }

            $model->updateOrFail(['finished_at' => now()]);

            return $model;
        });
    }
}
