<?php

namespace App\Livewire\Dashboard\Ui;

use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Actions\Support\Actions;
use Livewire\Component;

class Header extends Component
{
    public function render()
    {
        return view('livewire.dashboard.ui.header')->with([
            'actions' => $this->actions(),
        ]);
    }

    protected function actions(): Actions
    {
        return Actions::make()
            ->add('content', fn (Action $item) => $item
                ->label(__('Content'))
                ->icon('heroicon-o-magnifying-glass')
                ->iconActive('heroicon-s-magnifying-glass')
                ->route('dashboard.post')
            )
            ->add('post', fn (Action $item) => $item
                ->label(__('Post'))
                ->icon('heroicon-o-user')
                ->iconActive('heroicon-s-user')
                ->route('dashboard.post')
            );
    }
}
