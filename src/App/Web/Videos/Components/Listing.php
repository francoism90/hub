<?php

namespace App\Web\Videos\Components;

use App\Web\Tags\Concerns\WithTags;
use App\Web\Videos\Concerns\WithFilters;
use App\Web\Videos\Concerns\WithVideos;
use Domain\Tags\Collections\TagCollection;
use Domain\Tags\Models\Tag;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

abstract class Listing extends Component
{
    use WithFilters;
    use WithPagination;
    use WithTags;
    use WithVideos;

    abstract public function render(): View;

    abstract protected function builder(): Paginator;
}
