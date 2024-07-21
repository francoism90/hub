<?php

namespace App\Web\Videos\Components;

use App\Web\Videos\Concerns\WithVideo;
use Domain\Videos\Actions\GetSimilarVideos;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;

class Next extends Section
{
    use WithVideo;

    #[Computed]
    public function items(): Collection
    {
        return app(GetSimilarVideos::class)->execute($this->getVideo(), limit: 24)->collect();
    }

    protected function getTitle(): ?string
    {
        return __('Next');
    }
}
