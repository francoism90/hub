<?php

namespace App\Web\Videos\Components;

use Domain\Tags\Collections\TagCollection;
use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Reactive;

class Filters extends Component
{
    #[Reactive]
    public ?string $tag = null;

    public ?string $type = 'genre';

    public function render(): View
    {
        return view('videos::filters');
    }

    #[Computed]
    public function tags(): TagCollection
    {
        return Tag::query()
            ->type($this->type)
            ->inRandomSeedOrder()
            ->get();
    }

    #[Computed]
    public function name(): ?string
    {
        return TagType::tryFrom($this->type)->label;
    }

    public function toggle(): void
    {
        $types = collect(TagType::toValues());

        $this->type = $types->after($this->type, $types->first());
    }
}
