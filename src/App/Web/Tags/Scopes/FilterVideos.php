<?php

declare(strict_types=1);

namespace App\Web\Tags\Scopes;

use App\Web\Tags\Forms\QueryForm;
use Domain\Tags\Models\Tag;
use Laravel\Scout\Builder;

class FilterVideos
{
    public function __construct(
        protected readonly QueryForm $form,
        protected readonly Tag $tag,
    ) {}

    public function __invoke(Builder $query): void
    {
        $query
            ->whereIn('tagged', [$this->tag->getKey()])
            ->when($this->form->is('type', 'newest'), fn (Builder $query) => $query->orderByDesc('created_at'))
            ->when($this->form->is('type', 'ordered'), fn (Builder $query) => $query->orderBy('name'))
            ->when($this->form->is('type', 'longest'), fn (Builder $query) => $query->orderByDesc('duration'))
            ->when($this->form->is('type', 'shortest'), fn (Builder $query) => $query->orderBy('duration'));
    }
}
