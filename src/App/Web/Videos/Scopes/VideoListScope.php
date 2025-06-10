<?php

declare(strict_types=1);

namespace App\Web\Videos\Scopes;

use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Builder;

class VideoListScope
{
    public function __construct(
        protected readonly User $user,
        protected readonly int $limit,
    ) {}

    public function __invoke(Builder $query): void
    {
        $query
            ->published()
            ->limit($this->limit);
    }
}
