<?php

namespace App\Livewire\Dashboard\Videos\Scopes;

use App\Livewire\Dashboard\Videos\Forms\QueryForm;
use Domain\Videos\Models\Video;
use Illuminate\Database\Eloquent\Builder as Eloquent;
use Laravel\Scout\Builder;

class ListVideos
{
    public function __construct(
        protected readonly QueryForm $form,
    ) {
    }

    public function __invoke(Builder $query): void
    {
        $query
            ->query(fn (Eloquent $query) => $this->form->filled('untagged')
                ? $query->whereDoesntHave('tags')
                : $query->with('tags')
            )
            ->when($this->shouldRandomize(), fn (Builder $query) => $query->whereIn('id', static::randomKeys()))
            ->when($this->form->isStrict('sort', 'recent'), fn (Builder $query) => $query->orderBy('created_at', 'desc'))
            ->when($this->form->isStrict('sort', 'updated'), fn (Builder $query) => $query->orderBy('updated_at', 'desc'))
            ->when($this->form->get('visibility'), fn (Builder $query, array $value) => $query->whereIn('state', $value));
    }

    protected function shouldRandomize(): bool
    {
        return $this->form->blank('query')
            && $this->form->isStrict('sort', 'relevance');
    }

    protected static function randomKeys(): array
    {
        return Video::query()
            ->random()
            ->take(12 * 10)
            ->get()
            ->modelKeys();
    }
}
