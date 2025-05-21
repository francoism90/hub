<?php

declare(strict_types=1);

namespace App\Web\Videos\Components;

use App\Web\Videos\Concerns\WithVideo;
use Domain\Videos\Algos\GenerateVideoSuggestions;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;

class Next extends Section
{
    use WithVideo;

    #[Computed(persist: true, seconds: 60 * 20)]
    public function items(): Collection
    {
        $algo = GenerateVideoSuggestions::make()
            ->model($this->getVideo())
            ->limit($this->getLimit())
            ->run();

        return $algo->meta['items'];
    }

    protected function getTitle(): ?string
    {
        return __('Next');
    }
}
