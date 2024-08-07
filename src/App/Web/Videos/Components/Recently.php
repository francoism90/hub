<?php

namespace App\Web\Videos\Components;

use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;

class Recently extends Section
{
    #[Computed(persist: true)]
    public function items(): Collection
    {
        return $this->getQuery()
            ->latest()
            ->take(24)
            ->get();
    }

    protected function getTitle(): ?string
    {
        return __('Recently Added');
    }
}
