<?php

namespace App\Web\Lists\Scopes;

use App\Web\Lists\Forms\QueryForm;
use Illuminate\Database\Eloquent\Builder;

class FilterVideos
{
    public function __construct(
        protected readonly QueryForm $form,
    ) {}

    public function __invoke(Builder $query): void
    {
        $query
            ->when(! $this->hasQuery(), fn (Builder $query) => $query->recommended());
    }

    protected function hasQuery(): bool
    {
        return $this->form->query()->isNotEmpty();
    }
}
