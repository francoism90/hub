<?php

declare(strict_types=1);

namespace App\Web\Videos\Components;

use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;

class Recently extends Section
{
    #[Computed(persist: true, seconds: 60 * 20)]
    public function items(): Collection
    {
        return $this->getQuery()
            ->published()
            ->recent()
            ->take(24)
            ->get();
    }

    protected function getTitle(): ?string
    {
        return __('Recently Added');
    }
}
