<?php

namespace App\Videos\Components;

use App\Videos\Enums\FeedType;
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
            ...static::feeds(),
            // ...static::tagged($model),
        ]);
    }

    protected static function feeds(): Collection
    {
        return collect(FeedType::cases())
            ->flatMap(fn (FeedType $type) => ['feed:'.$type->value => $type->label()]);
    }
}
