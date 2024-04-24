<?php

namespace App\Livewire\Dashboard\Content;

use App\Livewire\Dashboard\Videos\Forms\QueryForm;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Actions\Support\ActionGroup;
use Illuminate\View\View;
use Livewire\Component;

class Videos extends Component
{
    public QueryForm $form;

    public function render(): View
    {
        return view('livewire.dashboard.content.videos')->with([
            'filters' => $this->filters(),
        ]);
    }

    public function updated(): void
    {
        $this->validate();
    }

    protected function filters(): ActionGroup
    {
        return ActionGroup::make()
            ->add('sort', fn (Action $item) => $item
                ->label(__('Sort by'))
                ->icon('heroicon-s-chevron-down')
                ->bladeAttributes([
                    'class:icon' => 'size-3',
                ])
            );
    }
}
