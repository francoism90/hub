<?php

namespace App\Livewire\Dashboard\Videos\Filters;

use Foxws\WireUse\Actions\Concerns\HasAction;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Sorters extends Component
{
    use HasAction;

    #[Validate('required')]
    public string $sort = 'recent';

    public function mount(): void
    {
        dd($this->action->getParent());

        $this->sync();
    }

    public function render()
    {
        return view('livewire.dashboard.videos.filters.sorters');
    }

    public function update()
    {
        $this->validate();

        $this->sync();
    }

    protected function sync(): void
    {
        $values = $this->action->only('sort')->toArray();

        $this->fill($values);
    }
}
