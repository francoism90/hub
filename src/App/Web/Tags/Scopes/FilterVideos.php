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
            ->query(fn ($query) => $query->with(['media', 'tags']))
            ->whereIn('tagged', [$this->tag->getKey()])
            ->when($this->form->is('type', 'newest'), fn (Builder $query) => $query->orderBy('created_at', 'desc'))
            ->when($this->form->is('type', 'longest'), fn (Builder $query) => $query->orderBy('duration', 'desc'))
            ->when($this->form->is('type', 'shortest'), fn (Builder $query) => $query->orderBy('duration'));
    }
}
