<?php

namespace App\Livewire\Dashboard\Videos\Components\Edit;

use App\Livewire\Dashboard\Videos\States\VideoState;
use Domain\Videos\Actions\GetSimilarVideos;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Foxws\WireUse\States\Concerns\WithState;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

/**
 * @property VideoState $state
 */
class Similar extends Component
{
    use WithQueryBuilder;
    use WithState;

    public function render(): View
    {
        return view('livewire.dashboard.videos.edit.similar');
    }

    #[Computed()]
    public function items(): Collection
    {
        return app(GetSimilarVideos::class)->execute(
            $this->getModel()
        );
    }

    protected static function getModelClass(): ?string
    {
        return Video::class;
    }

    protected function getModel(): Video
    {
        return Video::findByPrefixedIdOrFail(
            $this->state->id
        );
    }
}
