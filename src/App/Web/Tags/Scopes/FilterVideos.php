<?php

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
            ->when($this->form->isStrict('type', 'recent'), fn (Builder $query) => $query->orderBy('created_at', 'desc'))
            ->when($this->form->isStrict('type', 'longest'), fn (Builder $query) => $query->orderBy('duration', 'desc'));
    }
}
