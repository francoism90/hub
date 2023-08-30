<?php

namespace App\Web\Filters\Components;

use App\Web\Tags\Concerns\WithTags;
use Domain\Tags\Collections\TagCollection;
use Domain\Tags\Models\Tag;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Modelable;
use Livewire\Component;

class Tags extends Component
{
    use WithTags;

    #[Modelable]
    public ?string $tag = '';

    public ?string $type = '';

    public function render(): View
    {
        return view('filters::tags');
    }

    public function mount(): void
    {
        $types = $this->tagTypes();

        $this->type = (filled($this->tag) && $tag = $this->findTagModel($this->tag))
            ? $types->first(fn (string $type) => $tag->type?->value === $type)
            : $types->first();
    }

    public function toggleType(): void
    {
        $types = $this->tagTypes();

        $this->type = $types->after($this->type, $types->first());
    }

    #[Computed()]
    public function tags(): TagCollection
    {
        return Tag::query()
            ->type($this->type)
            ->orderBy('name')
            ->get()
            ->sortByDesc(fn (Tag $item) => $item->getRouteKey() === $this->tag);
    }

    #[Computed]
    public function tagType(): string
    {
        $label = $this->findTagType($this->type)?->label;

        return str($label)->plural();
    }

    #[Computed]
    public function tagName(): mixed
    {
        return $this->findTagModel($this->tag)?->name;
    }
}
