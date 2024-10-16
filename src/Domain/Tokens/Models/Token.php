<?php

declare(strict_types=1);

namespace Domain\Tokens\Models;

use Domain\Tokens\Collections\TokenCollection;
use Domain\Tokens\QueryBuilders\TokenQueryBuilder;
use Laravel\Sanctum\PersonalAccessToken;

class Token extends PersonalAccessToken
{
    /**
     * @var string
     */
    protected $table = 'personal_access_tokens';

    public function newEloquentBuilder($query): TokenQueryBuilder
    {
        return new TokenQueryBuilder($query);
    }

    public function newCollection(array $models = []): TokenCollection
    {
        return new TokenCollection($models);
    }
}
