<?php

declare(strict_types=1);

namespace App\Web\Videos\Scopes;

use App\Web\Videos\Forms\QueryForm;
use Illuminate\Database\Eloquent\Builder;

class FilterVideos
{
    public function __construct(
        protected readonly QueryForm $form,
    ) {}

    public function __invoke(Builder $query): void
    {
        $query
            ->with('video', 'video.media', 'video.tags')
            ->when($this->form->is('type', 'daily'), fn (Builder $query) => $query->orderByDesc('created_at'))
            ->when($this->form->is('type', 'discover'), fn (Builder $query) => $query->orderByDesc('created_at'));
    }
}
