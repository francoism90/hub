<?php

declare(strict_types=1);

namespace Domain\Imports\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class ImportQueryBuilder extends Builder
{
    public function pending(): self
    {
        return $this
            ->whereNull('finished_at');
    }

    public function processed(): self
    {
        return $this
            ->orWhereNotNull('finished_at');
    }
}
