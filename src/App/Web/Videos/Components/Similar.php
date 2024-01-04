<?php

namespace App\Web\Videos\Components;

use App\Web\Videos\Concerns\WithVideo;
use Domain\Videos\Actions\GetSimilarVideos;
use Domain\Videos\Models\Video;
use Foxws\LivewireUse\Views\Concerns\WithQueryBuilder;
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

    protected static string $model = Video::class;

    public function render(): View
    {
        return view('videos.similar');
    }

    #[Computed]
    public function items(): LazyCollection
    {
        return app(GetSimilarvideos::class)->execute($this->video);
    }
}
