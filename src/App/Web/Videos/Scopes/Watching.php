<?php

namespace App\Videos\Scopes;

use Illuminate\Database\Eloquent\Builder;

class Watching
{
    public function __invoke(Builder $query): void
    {
        $query;
    }
}
