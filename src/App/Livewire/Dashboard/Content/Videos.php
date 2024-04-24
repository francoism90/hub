<?php

namespace App\Livewire\Dashboard\Content;

use App\Livewire\Dashboard\Videos\Filters\Sorters;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Actions\Support\ActionGroup;
use Livewire\Component;

class Videos extends Component
{
    public $foo = 'bar';

    public function render()
    {
        return view('livewire.dashboard.content.videos')->with([
            'filters' => $this->filters(),
        ]);
    }

    protected function filters(): ActionGroup
    {
        return ActionGroup::make()
            ->add('sort', fn (Action $item) => $item
                ->label(__('Sort by'))
                ->icon('heroicon-s-chevron-down')
                ->attributes(['foo' => $this->foo])
                ->livewire(Sorters::class)
            );
    }
}
