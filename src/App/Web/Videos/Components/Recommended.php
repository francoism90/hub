<?php

namespace App\Web\Videos\Components;

use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Lazy;

#[Lazy]
class Recommended extends Section
{
    #[Computed]
    public function items(): Collection
    {
        return $this->getQuery()
            ->random()
            ->take(16)
            ->get();
    }

    protected function getTitle(): ?string
    {
        return __('Recommended');
    }
}
