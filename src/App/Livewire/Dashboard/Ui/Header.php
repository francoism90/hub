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
            Action::make('dashboard')
                ->label(__('Dashboard'))
                ->icon('heroicon-o-user')
                ->iconActive('heroicon-s-user')
                ->route('dashboard.index'),

            Action::make('activity')
                ->label(__('Activity'))
                ->icon('heroicon-o-bell')
                ->iconActive('heroicon-s-bell')
                ->route('dashboard.activity'),
        ];
    }
}
