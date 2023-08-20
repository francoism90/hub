<?php

namespace Domain\Users\QueryBuilders;

use Domain\Users\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class UserIndexQuery extends QueryBuilder
{
    public function __construct(Request $request)
    {
        $query = User::query()->with(['media.avatar']);

        parent::__construct($query, $request);

        $this
            ->allowedFilters('email', 'name')
            ->allowedSorts('email', 'name');
    }
}
