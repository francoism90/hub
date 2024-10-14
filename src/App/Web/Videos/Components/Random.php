<?php

declare(strict_types=1);

namespace App\Web\Videos\Components;

use App\Web\Videos\Concerns\WithVideo;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;

class Random extends Section
{
    use WithVideo;

    #[Computed(persist: true, seconds: 60 * 20)]
    public function items(): Collection
    {
        return $this->getQuery()
            ->whereKeyNot($this->getVideoKey())
            ->published()
            ->feed()
            ->take(24)
            ->get();
    }

    protected function getTitle(): ?string
    {
        return __('Random Picks');
    }
}
