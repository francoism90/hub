<?php

declare(strict_types=1);

namespace App\Web\Account\Scopes;

use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Builder;

class DiscoverScope
{
    public function __construct(
        protected readonly ?User $user = null,
        protected readonly ?int $limit = null,
    ) {}

    public function __invoke(Builder $query): void
    {
        $query
            ->published();
    }
}
