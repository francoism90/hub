<?php

declare(strict_types=1);

namespace Domain\Imports\QueryBuilders;

use Domain\Imports\States\Failed;
use Domain\Imports\States\Finished;
use Domain\Imports\States\Pending;
use Illuminate\Database\Eloquent\Builder;

class ImportQueryBuilder extends Builder
{
    public function pending(): self
    {
        return $this
            ->whereState('state', Pending::class)
            ->whereNull('finished_at');
    }

    public function finished(): self
    {
        return $this
            ->whereState('state', Finished::class)
            ->orWhereNotNull('finished_at');
    }

    public function failed(): self
    {
        return $this
            ->whereState('state', Failed::class);
    }
}
