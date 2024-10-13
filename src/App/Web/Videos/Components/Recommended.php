<?php

namespace App\Web\Videos\Components;

use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;

class Recommended extends Section
{
    #[Computed(persist: true, seconds: 60 * 20)]
    public function items(): Collection
    {
        return $this->getQuery()
            ->published()
            ->take(24)
            ->get();
    }

    protected function getTitle(): ?string
    {
        return __('Recommended');
    }
}
