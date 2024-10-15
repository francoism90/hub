<?php

declare(strict_types=1);

namespace Domain\Groups\QueryBuilders;

use Domain\Groups\Enums\GroupClass;
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

    public function history(): self
    {
        return $this
            ->where('category', GroupClass::Viewed)
            ->where('type', GroupType::Private);
    }
}
