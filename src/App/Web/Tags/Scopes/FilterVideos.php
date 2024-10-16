<?php

declare(strict_types=1);

namespace App\Web\Tags\Scopes;

use App\Web\Tags\Forms\QueryForm;
use Domain\Tags\Models\Tag;
use Domain\Videos\QueryBuilders\VideoQueryBuilder;
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
            ->query(fn (VideoQueryBuilder $query) => $query->with('media', 'tags'))
            ->whereIn('tagged', [$this->tag->getKey()])
            ->when($this->form->is('type', 'daily'), fn (Builder $query) => $query->orderByDesc('created_at'))
            ->when($this->form->is('type', 'discover'), fn (Builder $query) => $query->orderByDesc('created_at'));
    }
}
