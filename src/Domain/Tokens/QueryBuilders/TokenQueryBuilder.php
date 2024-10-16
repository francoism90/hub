<?php

declare(strict_types=1);

namespace Domain\Tokens\QueryBuilders;

use ArrayAccess;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class TokenQueryBuilder extends Builder
{
    public function active(ArrayAccess|array|null $name = null): self
    {
        return $this
            ->withWhereHas('tokens', fn (Builder $query) => $query
                ->whereIn('name', $name)
                ->whereNull('expires_at')
                ->orWhere('expires_at', '<=', Carbon::today())
            );
    }
}
