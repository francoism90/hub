<?php

namespace App\Livewire\Dashboard\Videos\Filters;

use Foxws\WireUse\Actions\Concerns\HasAction;
use Livewire\Component;

class Sorters extends Component
{
    use HasAction;

    public string $sort = 'recent';

    public function mount(): void
    {
        $attributes = $this->action->getInstance();

        $this->fill([
            'sort' => $attributes->get('form.sort'),
        ]);
    }

    public function updated(): void
    {
        $attributes = $this->action->getInstance();

        dd($attributes->get('form.sort'));

        // $this->fill([
        //     'sort' => $attributes->get('form.sort'),
        // ]);
    }

    public function render()
    {
        return view('livewire.dashboard.videos.filters.sorters');
    }
}
