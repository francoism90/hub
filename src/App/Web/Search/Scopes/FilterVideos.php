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
            ->when(! $this->hasQuery(), fn (Builder $query) => $query->whereIn('id', [0]));
    }

    protected function hasQuery(): bool
    {
        return filled($this->form->query());
    }
}
