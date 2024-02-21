<?php

namespace App\Videos\Components;

use App\Videos\Concerns\WithVideo;
use Domain\Videos\Actions\GetSimilarVideos;
use Domain\Videos\Models\Video;
use Foxws\LivewireUse\Models\Concerns\WithQueryBuilder;
use Illuminate\Support\LazyCollection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Lazy;
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

    #[Computed]
    public function items(): LazyCollection
    {
        return app(GetSimilarvideos::class)->execute($this->video);
    }

    protected static function getModelClass(): ?string
    {
        return Video::class;
    }
}
