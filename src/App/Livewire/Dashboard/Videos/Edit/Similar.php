<?php

namespace App\Livewire\Dashboard\Videos\Edit;

use App\Livewire\Videos\Concerns\WithVideo;
use Domain\Videos\Actions\GetSimilarVideos;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Similar extends Component
{
    use WithQueryBuilder;
    use WithVideo;

    public function render(): View
    {
        return view('livewire.dashboard.videos.tabs.similar');
    }

    #[Computed]
    public function items(): Collection
    {
        return app(GetSimilarVideos::class)->execute($this->video);
    }

    protected static function getModelClass(): ?string
    {
        return Video::class;
    }
}
