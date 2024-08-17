<?php

namespace App\Web\Videos\Components;

use App\Web\Videos\Concerns\WithVideo;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;

class Random extends Section
{
    use WithVideo;

    #[Computed(persist: true)]
    public function items(): Collection
    {
        return $this->getQuery()
            ->random()
            ->whereKeyNot($this->getVideoKey())
            ->take(24)
            ->get();
    }

    protected function getTitle(): ?string
    {
        return __('Random Picks');
    }
}
