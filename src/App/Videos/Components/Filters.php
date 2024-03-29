<?php

namespace App\Videos\Components;

use Domain\Tags\Models\Tag;
use Domain\Videos\Enums\FilterType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Modelable;
use Livewire\Component;

class Filters extends Component
{
    #[Modelable]
    public string $value = '';

    public function render(): View
    {
        return view('videos.filters');
    }

    #[Computed]
    public function items(): Collection
    {
        return collect()->merge([
            ...$this->filters(),
            ...$this->tags(),
        ])->unique();
    }

    protected function filters(): Collection
    {
        return collect(FilterType::cases())
            ->flatMap(fn (FilterType $type) => ['filter:'.$type->value => $type->label()]);
    }

    protected function tags(): Collection
    {
        return Tag::query()
            ->recommended()
            ->take(10)
            ->get()
            ->flatMap(fn (Tag $tag) => [(string) $tag->name => (string) $tag->name]);
    }
}
