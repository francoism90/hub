<?php

declare(strict_types=1);

namespace App\Web\Videos\Scopes;

use App\Web\Videos\Forms\QueryForm;
use Domain\Groups\Enums\GroupSet;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Builder;

class FilterVideos
{
    public function __construct(
        protected readonly QueryForm $form,
        protected readonly User $user,
    ) {}

    public function __invoke(Builder $query): void
    {
        $query
            ->with(['media', 'tags'])
            ->when($this->filterByTag(), fn (Builder $query) => $this->tagged($query))
            ->when($this->form->is('list', 'all'), fn (Builder $query) => $this->recommended($query))
            ->when($this->form->is('list', 'discover'), fn (Builder $query) => $this->discover($query));
    }

    protected function filterByTag(): bool
    {
        return str($this->form->list)->startsWith('tag-');
    }

    protected function recommended(Builder $query): Builder
    {
        return $query
            ->published()
            ->inRandomOrder();
    }

    protected function discover(Builder $query): Builder
    {
        return $query
            ->published()
            ->whereDoesntHave('groups', fn (Builder $query) => $query
                ->where('groups.user_id', $this->user->getKey())
                ->where('groups.kind', GroupSet::Viewed)
            )
            ->inRandomOrder();
    }

    protected function tagged(Builder $query): Builder
    {
        return $query
            ->withWhereHas('tags', fn ($query) => $query->where('tags.prefixed_id', $this->form->list))
            ->inRandomOrder();
    }
}
