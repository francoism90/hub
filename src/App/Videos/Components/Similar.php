<?php

namespace App\Videos\Components;

use App\Videos\Concerns\WithVideo;
use Domain\Videos\Actions\GetSimilarVideos;
use Domain\Videos\Models\Video;
use Foxws\LivewireUse\Models\Concerns\WithQueryBuilder;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Component;

#[Lazy]
class Similar extends Component
{
    use WithQueryBuilder;
    use WithVideo;

    public function render(): View
    {
        return view('videos.similar');
    }

    #[Computed(persist: true, seconds: 300)]
    public function items(): Collection
    {
        return app(GetSimilarvideos::class)->execute($this->video);
    }

    #[On('video-updated.{video.prefixed_id}')]
    public function refresh(): void
    {
        unset($this->items);

        $this->dispatch('$refresh');
    }

    protected static function getModelClass(): ?string
    {
        return Video::class;
    }
}
