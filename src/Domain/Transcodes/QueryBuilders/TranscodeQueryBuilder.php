<?php

declare(strict_types=1);

namespace Domain\Transcodes\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class TranscodeQueryBuilder extends Builder
{
    public function pending(): self
    {
        return $this
            ->whereNull('finished_at')
            ->whereNull('expires_at')
            ->orWhere('expires_at', '>', now());
    }

    public function finished(): self
    {
        return $this
            ->whereNotNull('finished_at')
            ->where('finished_at', '<=', now());
    }

    public function expired(): self
    {
        return $this
            ->whereNotNull('expires_at')
            ->where('expires_at', '<=', now());
    }

    public function active(): self
    {
        return $this
            ->finished()
            ->whereNull('expires_at')
            ->orWhere('expires_at', '>', now());
    }
}
