<?php

namespace App\Web\Videos\Components;

use App\Web\Videos\Components\Section;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Lazy;

#[Lazy]
class Recently extends Section
{
    #[Computed]
    public function items(): Collection
    {
        return $this->getQuery()
            ->latest()
            ->take(16)
            ->get();
    }

    protected function getTitle(): ?string
    {
        return __('Recently Added');
    }
}