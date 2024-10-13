<?php

namespace App\Web\Library\Scopes;

use App\Web\Library\Forms\QueryForm;
use Illuminate\Database\Eloquent\Builder as Eloquent;
use Laravel\Scout\Builder;

class FilterVideos
{
    public function __construct(
        protected readonly QueryForm $form,
    ) {}

    public function __invoke(Builder $query): void
    {
        $query
            ->query(fn (Eloquent $query) => $query->with('video', 'video.media', 'video.tags'))
            ->when($this->form->is('type', 'daily'), fn (Builder $query) => $query->orderBy('updated_at', 'desc'));
    }
}
