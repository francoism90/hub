<?php

declare(strict_types=1);

namespace App\Web\Search\Scopes;

use App\Web\Search\Forms\QueryForm;
use Laravel\Scout\Builder;

class FilterVideos
{
    public function __construct(
        protected readonly QueryForm $form,
    ) {}

    public function __invoke(Builder $query): void
    {
        $query
            ->query(fn ($query) => $query->with(['media', 'tags']))
            ->when(! $this->hasQuery(), fn (Builder $query) => $query->whereIn('id', [0]))
            ->when($this->form->is('type', 'newest'), fn (Builder $query) => $query->orderByDesc('created_at'))
            ->when($this->form->is('type', 'longest'), fn (Builder $query) => $query->orderByDesc('duration'))
            ->when($this->form->is('type', 'shortest'), fn (Builder $query) => $query->orderBy('duration'));
    }

    protected function hasQuery(): bool
    {
        return filled($this->form->query());
    }
}
