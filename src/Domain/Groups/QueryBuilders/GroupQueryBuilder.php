<?php

declare(strict_types=1);

namespace Domain\Groups\QueryBuilders;

use Domain\Groups\Enums\GroupSet;
use Domain\Groups\Enums\GroupType;
use Domain\Groups\Models\Group;
use Domain\Groups\States\Verified;
use Illuminate\Database\Eloquent\Builder;

class GroupQueryBuilder extends Builder
{
    public function published(): self
    {
        return $this->whereState('state', Verified::class);
    }

    public function mixer(): self
    {
        return $this->where('type', GroupType::Mixer);
    }

    public function system(): self
    {
        return $this->where('type', GroupType::System);
    }

    public function personal(): self
    {
        return $this
            ->whereIn('type', [GroupType::Private, GroupType::Public]);
    }

    public function favorites(): ?Group
    {
        return $this
            ->system()
            ->firstWhere('kind', GroupSet::Favorite);
    }

    public function saved(): ?Group
    {
        return $this
            ->system()
            ->firstWhere('kind', GroupSet::Saved);
    }

    public function viewed(): ?Group
    {
        return $this
            ->system()
            ->firstWhere('kind', GroupSet::Viewed);
    }
}
