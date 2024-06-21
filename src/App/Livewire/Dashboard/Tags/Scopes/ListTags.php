<?php

namespace App\Livewire\Dashboard\Tags\Scopes;

use App\Livewire\Dashboard\Tags\Forms\QueryForm;
use Illuminate\Database\Eloquent\Builder as Eloquent;
use Laravel\Scout\Builder;

class ListTags
{
    public function __construct(
        protected readonly QueryForm $form,
    ) {}

    public function __invoke(Builder $query): void
    {
        $query
            ->query(fn (Eloquent $query) => $query->withCount('videos'))
            ->when($this->useOrdered(), fn (Builder $query) => $query->orderBy('order'))
            ->when($this->form->is('sort', 'recent'), fn (Builder $query) => $query->orderBy('created_at', 'desc'));
    }

    protected function useOrdered(): bool
    {
        return $this->form->blank('query', 'sort');
    }
}
