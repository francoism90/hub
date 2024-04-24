<?php

namespace App\Livewire\Dashboard\Content;

use App\Livewire\Dashboard\Videos\Filters\Sorters;
use App\Livewire\Dashboard\Videos\Forms\QueryForm;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Actions\Support\ActionGroup;
use Livewire\Component;

class Videos extends Component
{
    public QueryForm $form;

    public function render()
    {
        return view('livewire.dashboard.content.videos')->with([
            'filters' => $this->filters(),
        ]);
    }

    protected function filters(): ActionGroup
    {
        return ActionGroup::make()
            ->attributes($this->getFilterAttributes())
            ->add('sort', fn (Action $item) => $item
                ->label(__('Sort by'))
                ->icon('heroicon-s-chevron-down')
                ->livewire(Sorters::class)
            );
    }

    protected function getFilterAttributes(): array
    {
        return [
            'form' => $this->form->all(),
        ];
    }
}
