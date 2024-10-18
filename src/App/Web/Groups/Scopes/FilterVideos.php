<?php

declare(strict_types=1);

namespace App\Web\Groups\Scopes;

use App\Web\Groups\Forms\QueryForm;
use Domain\Groups\Models\Group;
use Illuminate\Database\Eloquent\Builder;

class FilterVideos
{
    public function __construct(
        protected readonly QueryForm $form,
        protected readonly Group $group,
    ) {}

    public function __invoke(Builder $query): void
    {
        $query
            ->with(['media', 'tags'])
            ->when($this->form->is('type', 'newest'), fn (Builder $query) => $query->orderByDesc('videoables.created_at'))
            ->when($this->form->is('type', 'oldest'), fn (Builder $query) => $query->orderBy('videoables.created_at'))
            ->when($this->form->is('type', 'recommended'), fn (Builder $query) => $query->inRandomOrder());
    }
}
