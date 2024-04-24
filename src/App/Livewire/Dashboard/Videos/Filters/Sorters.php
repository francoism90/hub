<?php

namespace App\Livewire\Dashboard\Videos\Filters;

use Foxws\WireUse\Actions\Concerns\HasAction;
use Livewire\Component;

class Sorters extends Component
{
    use HasAction;

    public function render()
    {
        return view('livewire.dashboard.videos.filters.sorters');
    }
}
