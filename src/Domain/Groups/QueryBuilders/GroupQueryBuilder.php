<?php

namespace Domain\Groups\QueryBuilders;

use Domain\Groups\Enums\GroupType;
use Domain\Groups\States\Verified;
use Illuminate\Database\Eloquent\Builder;

class GroupQueryBuilder extends Builder
{
    public function published(): self
    {
        return $this
            ->whereState('state', Verified::class);
    }

    public function mixer(): self
    {
        return $this
            ->where('type', GroupType::Mixer);
    }

    public function personal(): self
    {
        return $this
            ->whereIn('type', [GroupType::Private, GroupType::Public]);
    }
}
