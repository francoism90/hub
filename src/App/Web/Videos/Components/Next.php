<?php

namespace App\Web\Videos\Components;

use App\Web\Videos\Concerns\WithVideo;
use Domain\Videos\Actions\GetSimilarVideos;
use Illuminate\Support\LazyCollection;
use Livewire\Attributes\Computed;

class Next extends Section
{
    use WithVideo;

    #[Computed]
    public function items(): LazyCollection
    {
        return app(GetSimilarVideos::class)->execute($this->video, 24);
    }

    protected function getTitle(): ?string
    {
        return __('Next');
    }
}
