<?php

namespace App\Livewire\Dashboard\Tags\Scopes;

use App\Livewire\Dashboard\Tags\Forms\QueryForm;
use Illuminate\Database\Eloquent\Builder as Eloquent;
use Laravel\Scout\Builder;

class ListTags
{
    public function __construct(
        protected readonly QueryForm $form,
    ) {
    }

    public function __invoke(Builder $query): void
    {
        $query
            ->query(fn (Eloquent $query) => $query->withCount('videos'))
            ->when($this->form->isStrict('sort', 'recent'), fn (Builder $query) => $query->orderBy('created_at', 'desc'));
    }
}
