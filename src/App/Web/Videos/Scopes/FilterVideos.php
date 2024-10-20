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
            ->randomSeed('feed', now()->addMinutes(10))
            ->when($this->form->is('list', 'all'), fn (Builder $query) => $query->published())
            ->when($this->form->is('list', 'discover'), fn (Builder $query) => $this->discover($query))
            ->when($this->isTagged(), fn (Builder $query) => $this->tagged($query));
    }

    protected function discover(Builder $query): Builder
    {
        return $query
            ->published()
            ->whereDoesntHave('groups', fn (Builder $query) => $query
                ->where('groups.user_id', $this->user->getKey())
                ->where('groups.kind', GroupSet::Viewed)
            );
    }

    protected function tagged(Builder $query): Builder
    {
        return $query
            ->withWhereHas('tags', fn ($query) => $query->where('tags.prefixed_id', $this->form->list));
    }

    protected function isTagged(): bool
    {
        return str($this->form->list)->startsWith('tag-');
    }
}
