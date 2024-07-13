<?php

namespace App\Web\Library\Scopes;

use App\Web\Library\Forms\QueryForm;
use Illuminate\Database\Eloquent\Builder;

class FilterVideos
{
    public function __construct(
        protected readonly QueryForm $form,
    ) {}

    public function __invoke(Builder $query): void
    {
        $query
            ->recommended()
            ->when($this->form->isStrict('type', 'untagged'), fn (Builder $query) => $query->whereDoesntHave('tags'))
            ->when($this->form->isStrict('type', 'new'), fn (Builder $query) => $query->whereDoesntHave('playlists.videos', fn (Builder $query) => $query
                ->where('playlists.user_id', auth()->id() ?? 0)
            ));
    }
}
