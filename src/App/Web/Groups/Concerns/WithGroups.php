<?php

declare(strict_types=1);

namespace App\Web\Groups\Concerns;

use Domain\Groups\Actions\CreateMixedGroups;
use Domain\Groups\Enums\GroupType;
use Domain\Groups\Models\Group;

trait WithGroups
{
    public function bootWithGroups(): void
    {
        $this->authorize('viewAny', Group::class);

        app(CreateMixedGroups::class)->execute(auth()->user());
    }

    protected function getGroupTypes(): array
    {
        return GroupType::cases();
    }
}
