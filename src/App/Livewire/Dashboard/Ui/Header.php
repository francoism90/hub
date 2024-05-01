<?php

namespace App\Livewire\Dashboard\Ui;

use Foxws\WireUse\Actions\Support\Action;
use Livewire\Component;

class Header extends Component
{
    public function render()
    {
        return view('livewire.dashboard.ui.header')->with([
            'actions' => $this->actions(),
        ]);
    }

    protected function actions(): array
    {
        return [
            Action::make('search')
                ->label(__('Search'))
                ->icon('heroicon-o-magnifying-glass')
                ->iconActive('heroicon-s-magnifying-glass')
                ->route('dashboard.index'),

            Action::make('profile')
                ->label(__('Profile'))
                ->icon('heroicon-o-user')
                ->iconActive('heroicon-s-user')
                ->route('dashboard.index'),
        ];
    }
}
